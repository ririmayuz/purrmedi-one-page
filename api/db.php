<?php
echo "✅ 成功載入 db.php<br>";
// 狀態 數字轉文字 0=待處理, 1=已確認, 2=完成, 3=取消
function statusText($code)
{
    $status_map = [
        0 => 'pending',
        1 => 'confirmed',
        2 => 'completed',
        3 => 'canceled'
    ];

    return isset($status_map[$code]) ? $status_map[$code] : 'unknown';
}


// 啟動 session 功能，這樣可以儲存使用者的瀏覽資料（像登入狀態）
session_start();

// 設定預設時區為台北，避免時間出錯
date_default_timezone_set("Asia/Taipei");

// 這是一個除錯用的函式，會用比較好看的格式印出陣列內容
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

// 這是快速查詢資料庫用的函式，傳入 SQL 語法後直接查詢並回傳所有結果
function q($sql)
{
    $dsn = 'mysql:host=localhost;dbname=dbpurr;charset=utf8';
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// 導向到別的網址的函式，例如跳轉到別頁面
function to($url)
{
    header("location:" . $url);
}

// 建立一個 DB 類別，用來操作資料表
class DB
{
    private $dsn = "mysql:host=localhost;dbname=dbpurr;charset=utf8"; // 連線資料庫用的設定
    private $pdo;   // 儲存 PDO 物件
    private $table; // 要操作的資料表名稱

    // 建構函式，建立物件時傳入資料表名稱
    function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, "root", ''); // 建立 PDO 物件
    }

    // 查詢全部資料，可加上條件與排序
    function all(...$arg)
    {
        $sql = "select * from $this->table "; // 基本查詢語法

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                // 如果傳入的是陣列，就轉成 SQL 條件語法
                $tmp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $tmp);
            } else {
                // 如果不是陣列就直接加到 SQL（可能是字串 like " where ... "）
                $sql .= $arg[0];
            }
        }

        // 第 2 個參數通常是排序，例如 " order by id desc"
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); // 執行查詢並回傳陣列結果
    }

    // 查詢總筆數（用 count(*)）
    function count(...$arg)
    {
        $sql = "select count(*) from $this->table ";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn(); // 只取回數字（筆數）
    }

    // 查詢單筆資料（根據 id 或條件）
    function find($id)
    {
        $sql = "select * from $this->table ";

        if (is_array($id)) {
            // 如果是陣列，組成條件語法
            $tmp = $this->arraytosql($id);
            $sql = $sql . " where " . join(" AND ", $tmp);
        } else {
            // 如果是單一數字，就用 id 查詢
            $sql .= " WHERE `id`='$id'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC); // 回傳單筆資料（關聯式陣列）
    }

    // 儲存資料：有 id 就更新，沒有 id 就新增
    function save($array)
    {
        if (isset($array['id'])) {
            // 更新資料
            $sql = "update $this->table set ";
            $tmp = $this->arraytosql($array);
            $sql .= join(" , ", $tmp) . " where `id`= '{$array['id']}'";
        } else {
            // 新增資料
            $cols = join("`,`", array_keys($array));
            $values = join("','", $array);
            $sql = "insert into $this->table (`$cols`) values('$values')";
        }

        return $this->pdo->exec($sql); // 執行 SQL 語法
    }

    // 刪除資料
    function del($id)
    {
        $sql = "delete from $this->table ";

        if (is_array($id)) {
            $tmp = $this->arraytosql($id);
            $sql = $sql . " where " . join(" AND ", $tmp);
        } else {
            $sql .= " WHERE `id`='$id'";
        }

        return $this->pdo->exec($sql); // 執行刪除
    }

    // 把陣列轉成 SQL 語法（像是 `欄位`='值'）
    private function arraytosql($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }

        return $tmp;
    }

}

// 建立操作不同資料表的物件
$Users = new DB('purr_users');
$Images = new DB('purr_images'); // 輪播用
$About = new DB('purr_about');
$Booking = new DB('purr_booking');

// $Carousel = new DB('carousel');
// $Title = new DB('title');
// $Admin = new DB('admin');
// $Bottom = new DB('bottom');

//上傳圖片處理（共用）
    function uploadImage($inputName = 'img', $dir = "../images/")
    {
        if (!empty($_FILES[$inputName]['tmp_name'])) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $filename = $_FILES[$inputName]['name'];
            move_uploaded_file($_FILES[$inputName]['tmp_name'], $dir . $filename);
            return $filename;
        }
        return null;
    }

    //模組預設欄位（狀態、時間、顯示）
    function getDefaultFields($table)
    {
        switch ($table) {
            case "purr_images":
                return ['sh' => 1];
            case "purr_booking":
                return [
                    'status' => 0,
                    'created_at' => date("Y-m-d H:i:s")
                ];
            default:
                return [];
        }
    }

    //table → do 的導向對應
    function redirectDo($table)
    {
        $map = [
            "purr_images" => "carousel",
            "purr_about" => "about",
            "purr_users" => "user",
            "purr_booking" => "booking"
        ];
        return $map[$table] ?? 'carousel';
    }