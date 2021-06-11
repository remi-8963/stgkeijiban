<?php
//配列
$array = ['みちや', 'もとき', 'なおきllll'];

for ($i = 0; $i < count($array); $i++) {
  echo $array[$i] . "さん\n";
}

foreach($array as $name) {
  echo $name . "さん\n";
}

//連想配列
$students = [
  [
    'name' => 'みちや',
    'age' => 22,
  ],
  [
    'name' => 'もとき',
    'age' => 21,
  ],
  [
    'name' => 'なおき',
    'age' => 21,
  ]];

for ($i = 0; $i < count($students); $i++) {
  echo $students[$i]['name'] . "さん(" . $students[$i]['age'] . "歳)\n";
  echo '<br>';
}

foreach($students as $key => $student) {
  echo "[$key] " . $student['name'] . "さん(" . $student['age'] . "歳)\n";
  echo '<br>';
}

//連想配列　書き方　別例
$student_ages = [
  'みちや' => 22,
  'もとき' => 21,
  'なおき' => 21,
];

foreach($student_ages as $name => $age) {
  echo "$name さん($age 歳)\n";
}