<?php
include 'db.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *'); 
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // QUERIES
 
  } catch(PDOException $e) {
    echo json_encode(['error' => 'cannot add to database']);
  }
  $conn = null;
  $stmt = $conn->prepare("INSERT IGNORE INTO players (`name`) VALUES ('". $name ."')");
$stmt->execute();
$stmt = $conn->prepare("SELECT id FROM players WHERE name='" . $name . "'");
$stmt->execute();

$id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
$stmt = $conn->prepare("INSERT INTO scores (`player_id`, `score`) VALUES ('". $id ."', '" . $score . "')");
$stmt->execute();
echo json_encode(['name' => $name, 'score' => (int)$score, 'id' => $id]);
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("SELECT * FROM scores ORDER BY score DESC LIMIT 10");
  $stmt->execute();
  
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  echo json_encode($results);
} catch(PDOException $e) {
    echo json_encode('[{"name":"error","msg":"' . $e->getMessage() . '"}]');
}

$conn = null;
?>