<pre>
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', "On");

$git = "/usr/bin/git";
$git_remote = "https://github.com/remi-8963/stgkeijiban.git";
$work_tree = "/home/tklab2021/public_html/091/stgkeijiban";
$git_dir = $work_tree . "/.git";
$command = "cd $work_tree && $git pull $git_remote master";

echo $command;

exec("$git --git-dir=$git_dir --work-tree=$work_tree pull $git_remote master", $output, $exit_status);
echo var_export($output) . PHP_EOL;
echo $exit_status . PHP_EOL;
?>
</pre>