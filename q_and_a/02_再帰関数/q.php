<!DOCTYPE html>
<html>
<head>
</head>
<body>
<pre>
<?php

// 下のようなディレクトリ構造があったときに、それを全部表示する関数

$tree = [
  [
    'filename' => 'a',
    'children' => [
      [
        'filename' => 'b',
        'children' => [
          [
            'filename' => 'c',
            'children' => [
              [
                'filename' => 'y'
              ]
            ]
          ],
          [
            'filename' => 'd'
          ]
        ]
      ]
    ]
  ],
  [
    'filename' => 'd',
    'children' => [
      [
        'filename' => 'e',
        'children' => [
          [
            'filename' => 's'
          ]
        ]
      ],
      [
        'filename' => 'p',
        'children' => [
          [
            'filename' => 'n'
          ]
        ]
      ]
    ]
  ],
  [
    'filename' => 'f',
    'children' => [
      [
        'filename' => 'h',
        'children' => [
          [
            'filename' => 's'
          ]
        ]
      ],
      [
        'filename' => 'p',
        'children' => [
          [
            'filename' => 'n'
          ]
        ]
      ]
    ]
  ],
];

function print_data($tree_data){
    echo $tree_data[0]['filename'];
    echo '<br>';
}

print_data($tree);

foreach($tree as $filename){
    echo $filename['filename'];
}

?>
</pre>
</body>
</html>