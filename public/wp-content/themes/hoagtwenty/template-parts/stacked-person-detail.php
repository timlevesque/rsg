<?php use HoagPeople\TemplateTags as Tags;
global $post;
global $count;
global $postCount;


$options = get_post_meta( get_the_ID(), 'post_options', true);

$distinct_title = null;
$endowed_chair = null;
$public_specialty = null;
$fblink = null;
$inlink = null;
$twitlink = null;
$instalink = null;
$no_link = null;

if(isset($options['distinct_title'])){
	$distinct_title = $options['distinct_title'];
}
if(isset($options['endowed_chair'])){
	$endowed_chair = $options['endowed_chair'];
}
if(isset($options['public_specialty'])){
	$public_specialty = $options['public_specialty'];
}
if(isset($options['facebook'])){
	$fblink = $options['facebook'];
}
if(isset($options['twitter'])){
	$twitlink = $options['twitter'];
}
if(isset($options['linkedin'])){
	$inlink = $options['linkedin'];
}
if(isset($options['instagram'])){
	$instalink = $options['instagram'];
}
if(isset($options['no_link'])){
	$no_link = $options['no_link'];
}

$fb = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNjk2cHgiIGhlaWdodD0iNjk2cHgiIHZpZXdCb3g9IjAgMCA2OTYgNjk2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA2MS4yICg4OTY1MykgLSBodHRwczovL3NrZXRjaC5jb20gLS0+CiAgICA8dGl0bGU+U2xpY2UgMTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoOC4yNTAwMDAsIDguOTUzMDAwKSI+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik00MjUuMjUsMjgzLjkyMiBMMzYyLjY3MiwyODMuOTIyIEwzNjIuNjcyLDIzOC4yMTkgQzM2Mi42NzIsMjI0LjE1NyAzNzcuMTU2LDIyMC45MjIgMzgzLjkwNiwyMjAuOTIyIEMzOTAuNjU2LDIyMC45MjIgNDI0LjQwNiwyMjAuOTIyIDQyNC40MDYsMjIwLjkyMiBMNDI0LjQwNiwxNTkuMTg4IEwzNzgsMTU4LjkwNyBDMzE0LjcxOSwxNTguOTA3IDMwMC4zNzUsMjA0Ljg5MSAzMDAuMzc1LDIzNC40MjMgTDMwMC4zNzUsMjgzLjc4MiBMMjU0LjUzMSwyODMuNzgyIEwyNTQuNTMxLDM0Ny40ODUgTDMwMC4zNzUsMzQ3LjQ4NSBDMzAwLjM3NSw0MjkuMDQ3IDMwMC4zNzUsNTE5LjA0NyAzMDAuMzc1LDUxOS4wNDcgTDM2Mi42NzIsNTE5LjA0NyBDMzYyLjY3Miw1MTkuMDQ3IDM2Mi42NzIsNDI4LjIwMyAzNjIuNjcyLDM0Ny40ODUgTDQxNS42ODgsMzQ3LjQ4NSBMNDI1LjI1LDI4My45MjIgWiIgaWQ9IlBhdGgiIGZpbGw9IiM4RjJBMkEiIGZpbGwtcnVsZT0ibm9uemVybyI+PC9wYXRoPgogICAgICAgICAgICA8Y2lyY2xlIGlkPSJPdmFsIiBzdHJva2U9IiM4RjJBMkEiIHN0cm9rZS13aWR0aD0iMTUiIGN4PSIzMzkuNjA5IiBjeT0iMzM5LjYwOSIgcj0iMzM5LjYwOSI+PC9jaXJjbGU+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4=';
$insta = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNjk2cHgiIGhlaWdodD0iNjk2cHgiIHZpZXdCb3g9IjAgMCA2OTYgNjk2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA2MS4yICg4OTY1MykgLSBodHRwczovL3NrZXRjaC5jb20gLS0+CiAgICA8dGl0bGU+U2xpY2UgMTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoOC4yNTAwMDAsIDguOTUzMDAwKSI+CiAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwiIHN0cm9rZT0iIzhGMkEyQSIgc3Ryb2tlLXdpZHRoPSIxNSIgY3g9IjMzOS42MDkiIGN5PSIzMzkuNjA5IiByPSIzMzkuNjA5Ij48L2NpcmNsZT4KICAgICAgICAgICAgPHBhdGggZD0iTTMzOS43NSwxOTYuMzEzIEMzODYuNzE5LDE5Ni4zMTMgMzkyLjIwMywxOTYuNDU0IDQxMC43NjYsMTk3LjI5NyBDNDI3LjkyMiwxOTguMTQxIDQzNy4yMDQsMjAwLjk1MyA0NDMuMzkxLDIwMy4zNDQgQzQ1MS41NDcsMjA2LjU3OCA0NTcuNDUzLDIxMC4zNzUgNDYzLjY0MSwyMTYuNTYzIEM0NjkuODI5LDIyMi43NTEgNDczLjYyNSwyMjguNTE2IDQ3Ni44NiwyMzYuODEzIEM0NzkuMjUxLDI0My4wMDEgNDgyLjA2MywyNTIuMjgyIDQ4Mi45MDcsMjY5LjQzOCBDNDgzLjc1MSwyODggNDgzLjg5MSwyOTMuNDg1IDQ4My44OTEsMzQwLjQ1NCBDNDgzLjg5MSwzODcuNDIzIDQ4My43NSwzOTIuOTA3IDQ4Mi45MDcsNDExLjQ3IEM0ODIuMDYzLDQyOC42MjYgNDc5LjI1MSw0MzcuOTA4IDQ3Ni44Niw0NDQuMDk1IEM0NzMuNjI2LDQ1Mi4yNTEgNDY5LjgyOSw0NTguMTU3IDQ2My42NDEsNDY0LjM0NSBDNDU3LjQ1Myw0NzAuNTMzIDQ1MS42ODgsNDc0LjMyOSA0NDMuMzkxLDQ3Ny41NjQgQzQzNy4yMDMsNDc5Ljk1NSA0MjcuOTIyLDQ4Mi43NjcgNDEwLjc2Niw0ODMuNjExIEMzOTIuMjA0LDQ4NC40NTUgMzg2LjcxOSw0ODQuNTk1IDMzOS43NSw0ODQuNTk1IEMyOTIuNzgxLDQ4NC41OTUgMjg3LjI5Nyw0ODQuNDU0IDI2OC43MzQsNDgzLjYxMSBDMjUxLjU3OCw0ODIuNzY3IDI0Mi4yOTYsNDc5Ljk1NSAyMzYuMTA5LDQ3Ny41NjQgQzIyNy45NTMsNDc0LjMzIDIyMi4wNDcsNDcwLjUzMyAyMTUuODU5LDQ2NC4zNDUgQzIwOS42NzEsNDU4LjE1NyAyMDUuODc1LDQ1Mi4zOTIgMjAyLjY0LDQ0NC4wOTUgQzIwMC4yNDksNDM3LjkwNyAxOTcuNDM3LDQyOC42MjYgMTk2LjU5Myw0MTEuNDcgQzE5NS43NDksMzkyLjkwOCAxOTUuNjA5LDM4Ny40MjMgMTk1LjYwOSwzNDAuNDU0IEMxOTUuNjA5LDI5My40ODUgMTk1Ljc1LDI4OC4wMDEgMTk2LjU5MywyNjkuNDM4IEMxOTcuNDM3LDI1Mi4yODIgMjAwLjI0OSwyNDMgMjAyLjY0LDIzNi44MTMgQzIwNS44NzQsMjI4LjY1NyAyMDkuNjcxLDIyMi43NTEgMjE1Ljg1OSwyMTYuNTYzIEMyMjIuMDQ3LDIxMC4zNzUgMjI3LjgxMiwyMDYuNTc5IDIzNi4xMDksMjAzLjM0NCBDMjQyLjI5NywyMDAuOTUzIDI1MS41NzgsMTk4LjE0MSAyNjguNzM0LDE5Ny4yOTcgQzI4Ny4yOTcsMTk2LjQ1MyAyOTIuNzgxLDE5Ni4zMTMgMzM5Ljc1LDE5Ni4zMTMgTTMzOS43NSwxNjQuNjcyIEMyOTIuMDc4LDE2NC42NzIgMjg2LjAzMSwxNjQuODEzIDI2Ny4zMjgsMTY1Ljc5NyBDMjQ4LjYyNSwxNjYuNjQxIDIzNS44MjgsMTY5LjU5NCAyMjQuNzE5LDE3My45NTMgQzIxMy4xODgsMTc4LjQ1MyAyMDMuMzQ0LDE4NC41IDE5My42NDEsMTk0LjIwMyBDMTgzLjkzOCwyMDMuOTA2IDE3Ny44OTEsMjEzLjc1IDE3My4zOTEsMjI1LjI4MSBDMTY5LjAzMiwyMzYuNTMxIDE2Ni4wNzksMjQ5LjE4NyAxNjUuMjM1LDI2Ny44OSBDMTY0LjM5MSwyODYuNTkzIDE2NC4xMSwyOTIuNjQgMTY0LjExLDM0MC4zMTIgQzE2NC4xMSwzODcuOTg0IDE2NC4yNTEsMzk0LjAzMSAxNjUuMjM1LDQxMi43MzQgQzE2Ni4wNzksNDMxLjQzNyAxNjkuMDMyLDQ0NC4yMzQgMTczLjM5MSw0NTUuMzQzIEMxNzcuODkxLDQ2Ni44NzQgMTgzLjkzOCw0NzYuNzE4IDE5My42NDEsNDg2LjQyMSBDMjAzLjM0NCw0OTYuMTI0IDIxMy4xODgsNTAyLjE3MSAyMjQuNzE5LDUwNi42NzEgQzIzNS45NjksNTExLjAzIDI0OC42MjUsNTEzLjk4MyAyNjcuMzI4LDUxNC44MjcgQzI4Ni4wMzEsNTE1LjY3MSAyOTIuMDc4LDUxNS45NTIgMzM5Ljc1LDUxNS45NTIgQzM4Ny40MjIsNTE1Ljk1MiAzOTMuNDY5LDUxNS44MTEgNDEyLjE3Miw1MTQuODI3IEM0MzAuODc1LDUxMy45ODMgNDQzLjY3Miw1MTEuMDMgNDU0Ljc4MSw1MDYuNjcxIEM0NjYuMzEyLDUwMi4xNzEgNDc2LjE1Niw0OTYuMTI0IDQ4NS44NTksNDg2LjQyMSBDNDk1LjU2Miw0NzYuNzE4IDUwMS42MDksNDY2Ljg3NCA1MDYuMTA5LDQ1NS4zNDMgQzUxMC40NjgsNDQ0LjA5MyA1MTMuNDIxLDQzMS40MzcgNTE0LjI2NSw0MTIuNzM0IEM1MTUuMTA5LDM5NC4wMzEgNTE1LjM5LDM4Ny45ODQgNTE1LjM5LDM0MC4zMTIgQzUxNS4zOSwyOTIuNjQgNTE1LjI0OSwyODYuNTkzIDUxNC4yNjUsMjY3Ljg5IEM1MTMuNDIxLDI0OS4xODcgNTEwLjQ2OCwyMzYuMzkgNTA2LjEwOSwyMjUuMjgxIEM1MDEuNjA5LDIxMy43NSA0OTUuNTYyLDIwMy45MDYgNDg1Ljg1OSwxOTQuMjAzIEM0NzYuMTU2LDE4NC41IDQ2Ni4zMTIsMTc4LjQ1MyA0NTQuNzgxLDE3My45NTMgQzQ0My41MzEsMTY5LjU5NCA0MzAuODc1LDE2Ni42NDEgNDEyLjE3MiwxNjUuNzk3IEMzOTMuNDY5LDE2NC44MTMgMzg3LjQyMiwxNjQuNjcyIDMzOS43NSwxNjQuNjcyIEwzMzkuNzUsMTY0LjY3MiBaIiBpZD0iU2hhcGUiIGZpbGw9IiM4RjJBMkEiIGZpbGwtcnVsZT0ibm9uemVybyI+PC9wYXRoPgogICAgICAgICAgICA8cGF0aCBkPSJNMzM5Ljc1LDI1MC4xNzIgQzI4OS44MjgsMjUwLjE3MiAyNDkuNDY5LDI5MC41MzEgMjQ5LjQ2OSwzNDAuNDUzIEMyNDkuNDY5LDM5MC4zNzUgMjg5LjgyOCw0MzAuNzM0IDMzOS43NSw0MzAuNzM0IEMzODkuNjcyLDQzMC43MzQgNDMwLjAzMSwzOTAuMzc1IDQzMC4wMzEsMzQwLjQ1MyBDNDMwLjAzMSwyOTAuNTMxIDM4OS42NzIsMjUwLjE3MiAzMzkuNzUsMjUwLjE3MiBaIE0zMzkuNzUsMzk5LjA5NCBDMzA3LjQwNiwzOTkuMDk0IDI4MS4xMDksMzcyLjc5NyAyODEuMTA5LDM0MC40NTMgQzI4MS4xMDksMzA4LjEwOSAzMDcuNDA2LDI4MS44MTIgMzM5Ljc1LDI4MS44MTIgQzM3Mi4wOTQsMjgxLjgxMiAzOTguMzkxLDMwOC4xMDkgMzk4LjM5MSwzNDAuNDUzIEMzOTguMzkxLDM3Mi43OTcgMzcyLjA5NCwzOTkuMDk0IDMzOS43NSwzOTkuMDk0IFoiIGlkPSJTaGFwZSIgZmlsbD0iIzhGMkEyQSIgZmlsbC1ydWxlPSJub256ZXJvIj48L3BhdGg+CiAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwiIGZpbGw9IiM4RjJBMkEiIGZpbGwtcnVsZT0ibm9uemVybyIgY3g9IjQzMy41NDciIGN5PSIyNDYuNjU2IiByPSIyMS4wOTQiPjwvY2lyY2xlPgogICAgICAgIDwvZz4KICAgIDwvZz4KPC9zdmc+';
$in = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNjk2cHgiIGhlaWdodD0iNjk2cHgiIHZpZXdCb3g9IjAgMCA2OTYgNjk2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA2MS4yICg4OTY1MykgLSBodHRwczovL3NrZXRjaC5jb20gLS0+CiAgICA8dGl0bGU+U2xpY2UgMTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSJHcm91cCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoOC4yNTAwMDAsIDguOTUzMDAwKSI+CiAgICAgICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwiIHN0cm9rZT0iIzhGMkEyQSIgc3Ryb2tlLXdpZHRoPSIxNSIgY3g9IjMzOS42MDkiIGN5PSIzMzkuNjA5IiByPSIzMzkuNjA5Ij48L2NpcmNsZT4KICAgICAgICAgICAgPHBhdGggZD0iTTMwNC43NSwyNzAuMTI0MjUzIEwzNzEuMjI3MjczLDI3MC4xMjQyNTMgTDM3MS4yMjcyNzMsMzAzLjYyNTI4MyBDMzgwLjgxMDIyNywyODQuMzYxNjc4IDQwNS4zNjU5MDksMjY3LjA0NyA0NDIuMjU1NjgyLDI2Ny4wNDcgQzUxMi45NjcwNDUsMjY3LjA0NyA1MjkuNzUsMzA1LjM4OTU3NSA1MjkuNzUsMzc1Ljc0NTg0MSBMNTI5Ljc1LDUwNi4wNDcgTDQ1OC4xNTkwOTEsNTA2LjA0NyBMNDU4LjE1OTA5MSwzOTEuNzY4MDczIEM0NTguMTU5MDkxLDM1MS43MDIyMzYgNDQ4LjU3NjEzNiwzMjkuMTA0OTQgNDI0LjIwNDU0NSwzMjkuMTA0OTQgQzM5MC40MDM0MDksMzI5LjEwNDk0IDM3Ni4zNDA5MDksMzUzLjQ2NjUyOCAzNzYuMzQwOTA5LDM5MS43NjgwNzMgTDM3Ni4zNDA5MDksNTA2LjA0NyBMMzA0Ljc1LDUwNi4wNDcgTDMwNC43NSwyNzAuMTI0MjUzIFoiIGlkPSJQYXRoIiBmaWxsPSIjOEYyQTJBIiBmaWxsLXJ1bGU9Im5vbnplcm8iPjwvcGF0aD4KICAgICAgICAgICAgPHBvbHlnb24gaWQ9IlBhdGgiIGZpbGw9IiM4RjJBMkEiIGZpbGwtcnVsZT0ibm9uemVybyIgcG9pbnRzPSIxODAuNzUgNTAyLjA0NyAyNTEuNzUgNTAyLjA0NyAyNTEuNzUgMjY3LjA0NyAxODAuNzUgMjY3LjA0NyI+PC9wb2x5Z29uPgogICAgICAgICAgICA8cGF0aCBkPSJNMjYzLjc1LDE5MC41NDcgQzI2My43NSwyMTYuMjI1MzMzIDI0Mi45MjgzMzMsMjM3LjA0NyAyMTcuMjUsMjM3LjA0NyBDMTkxLjU3MTY2NywyMzcuMDQ3IDE3MC43NSwyMTYuMjI1MzMzIDE3MC43NSwxOTAuNTQ3IEMxNzAuNzUsMTY0Ljg2ODY2NyAxOTEuNTcxNjY3LDE0NC4wNDcgMjE3LjI1LDE0NC4wNDcgQzI0Mi45MjgzMzMsMTQ0LjA0NyAyNjMuNzUsMTY0Ljg2ODY2NyAyNjMuNzUsMTkwLjU0NyBaIiBpZD0iUGF0aCIgZmlsbD0iIzhGMkEyQSIgZmlsbC1ydWxlPSJub256ZXJvIj48L3BhdGg+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4=';
$twit = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNjk1cHgiIGhlaWdodD0iNjk1cHgiIHZpZXdCb3g9IjAgMCA2OTUgNjk1IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA2MS4yICg4OTY1MykgLSBodHRwczovL3NrZXRjaC5jb20gLS0+CiAgICA8dGl0bGU+U2xpY2UgMTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxwYXRoIGQ9Ik00ODAuODkxLDI4NS44MjggQzQ4MC44OTEsMjgyLjczNCA0ODAuODkxLDI3OS42NCA0ODAuNzUsMjc2LjU0NyBDNDk0LjEwOSwyNjYuNTYzIDUwNS43ODEsMjU0LjA0NyA1MTQuOTIyLDIzOS43MDMgQzUwMi41NDcsMjQ1LjE4NyA0ODkuNDY5LDI0OC45ODQgNDc1LjU0NywyNTAuNTMxIEM0ODkuNzUsMjQxLjgxMiA1MDAuNTc4LDIyNy44OSA1MDUuNzgxLDIxMS4xNTYgQzQ5Mi41NjIsMjE5LjE3MiA0NzcuNzk3LDIyNC45MzcgNDYyLjE4NywyMjcuODkgQzQ0OS42NzEsMjEzLjY4NyA0MzEuODEyLDIwNC41NDYgNDEyLjEyNSwyMDQuMjY1IEMzNzQuMjk3LDIwMy43MDMgMzQzLjUsMjM1LjYyNCAzNDMuNSwyNzUuNzAzIEMzNDMuNSwyODEuNDY5IDM0NC4wNjIsMjg2Ljk1MyAzNDUuMzI4LDI5Mi4yOTcgQzI4OC4yMzQsMjg4LjY0MSAyMzcuNzUsMjU4Ljk2OSAyMDMuODU5LDIxNC4xMDkgQzE5Ny45NTMsMjI0Ljc5NyAxOTQuNTc4LDIzNy4zMTIgMTk0LjU3OCwyNTAuODEyIEMxOTQuNTc4LDI3Ni4yNjUgMjA2LjY3MiwyOTguNzY1IDIyNS4wOTQsMzEyLjEyNCBDMjEzLjg0NCwzMTEuNTYyIDIwMy4yOTcsMzA4LjE4NiAxOTQuMDE2LDMwMi41NjIgQzE5NC4wMTYsMzAyLjg0MyAxOTQuMDE2LDMwMy4xMjQgMTk0LjAxNiwzMDMuNTQ2IEMxOTQuMDE2LDMzOC45ODQgMjE3LjY0MSwzNjguNzk2IDI0OSwzNzUuNjg3IEMyNDMuMjM0LDM3Ny4zNzUgMjM3LjE4OCwzNzguMjE4IDIzMSwzNzguMDc4IEMyMjYuNSwzNzguMDc4IDIyMi4yODEsMzc3LjUxNiAyMTguMDYyLDM3Ni42NzIgQzIyNi43ODEsNDA1Ljc4MSAyNTIuMDkzLDQyNy4wMTYgMjgyLjE4Nyw0MjcuNzE5IEMyNTguNzAzLDQ0Ny4xMjUgMjI5LjE3MSw0NTguNzk3IDE5Ni45NjgsNDU4Ljc5NyBDMTkxLjQ4NCw0NTguNzk3IDE4NS45OTksNDU4LjM3NSAxODAuNjU2LDQ1Ny44MTMgQzIxMS4wMzEsNDc4LjYyNSAyNDcuMDMxLDQ5MC43MTkxMzQgMjg1Ljg0NCw0OTAuNzE5MTM0IEM0MTEuODQ0LDQ5MC44NTkgNDgwLjg5MSwzODEuMDMxIDQ4MC44OTEsMjg1LjgyOCBaIiBpZD0iUGF0aCIgZmlsbD0iIzhGMkEyQSIgZmlsbC1ydWxlPSJub256ZXJvIj48L3BhdGg+CiAgICAgICAgPGNpcmNsZSBpZD0iT3ZhbCIgc3Ryb2tlPSIjOEYyQTJBIiBzdHJva2Utd2lkdGg9IjE1IiBjeD0iMzQ3Ljg1OSIgY3k9IjM0Ny41NjIiIHI9IjMzOS42MDkiPjwvY2lyY2xlPgogICAgPC9nPgo8L3N2Zz4=';
$tube = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNjk1cHgiIGhlaWdodD0iNjk1cHgiIHZpZXdCb3g9IjAgMCA2OTUgNjk1IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA2MS4yICg4OTY1MykgLSBodHRwczovL3NrZXRjaC5jb20gLS0+CiAgICA8dGl0bGU+U2xpY2UgMTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPgogICAgICAgIDxwb2x5Z29uIGlkPSJwYXRoLTEiIHBvaW50cz0iMCAwIDQyMiAwIDQyMiAyOTggMCAyOTgiPjwvcG9seWdvbj4KICAgIDwvZGVmcz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxjaXJjbGUgaWQ9Ik92YWwiIHN0cm9rZT0iIzhGMkEyQSIgc3Ryb2tlLXdpZHRoPSIxNSIgY3g9IjM0Ny44NTkiIGN5PSIzNDcuNTYyIiByPSIzMzkuNjA5Ij48L2NpcmNsZT4KICAgICAgICA8ZyBpZD0iRmlsbC0xLUNsaXBwZWQiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDEzNy4wMDAwMDAsIDE5OS4wMDAwMDApIj4KICAgICAgICAgICAgPG1hc2sgaWQ9Im1hc2stMiIgZmlsbD0id2hpdGUiPgogICAgICAgICAgICAgICAgPHVzZSB4bGluazpocmVmPSIjcGF0aC0xIj48L3VzZT4KICAgICAgICAgICAgPC9tYXNrPgogICAgICAgICAgICA8ZyBpZD0icGF0aC0xIj48L2c+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik0xNjcsMjEyIEwxNjcsODYgTDI3OCwxNDkuMDAyNDA3IEwxNjcsMjEyIFogTTQxNC4xMzkzNjQsNDYuNTMzNjYxIEM0MDkuMjYzMzY0LDI4LjIxNjI3NCAzOTQuODk1NTQ1LDEzLjc5MjExMyAzNzYuNjUzOTA5LDguODk2NzQyIEMzNDMuNTg5MTM2LDAgMjExLDAgMjExLDAgQzIxMSwwIDc4LjQxMDg2NCwwIDQ1LjM0NjA5MSw4Ljg5Njc0MiBDMjcuMTA0NDU1LDEzLjc5MjExMyAxMi43MzY2MzYsMjguMjE2Mjc0IDcuODYwNjM2LDQ2LjUzMzY2MSBDLTEsNzkuNzMxODIzIC0xLDE0OSAtMSwxNDkgQy0xLDE0OSAtMSwyMTguMjY1Nzc0IDcuODYwNjM2LDI1MS40NjYzMzkgQzEyLjczNjYzNiwyNjkuNzgzNzI2IDI3LjEwNDQ1NSwyODQuMjA3ODg3IDQ1LjM0NjA5MSwyODkuMTA1NjYxIEM3OC40MTA4NjQsMjk4IDIxMSwyOTggMjExLDI5OCBDMjExLDI5OCAzNDMuNTg5MTM2LDI5OCAzNzYuNjUzOTA5LDI4OS4xMDU2NjEgQzM5NC44OTU1NDUsMjg0LjIwNzg4NyA0MDkuMjYzMzY0LDI2OS43ODM3MjYgNDE0LjEzOTM2NCwyNTEuNDY2MzM5IEM0MjMsMjE4LjI2NTc3NCA0MjMsMTQ5IDQyMywxNDkgQzQyMywxNDkgNDIzLDc5LjczMTgyMyA0MTQuMTM5MzY0LDQ2LjUzMzY2MSBMNDE0LjEzOTM2NCw0Ni41MzM2NjEgWiIgaWQ9IkZpbGwtMSIgZmlsbD0iIzhGMkEyQSIgZmlsbC1ydWxlPSJub256ZXJvIiBtYXNrPSJ1cmwoI21hc2stMikiPjwvcGF0aD4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==';


?>

<div class="<?php if(is_odd($postCount)){echo('justify-content-md-end');}else{echo('justify-content-md-start');}?> slideup justify-content-center row d-flex m-auto py-5 px-3 border-top border-tertiary position-relative <?php if ($no_link == null): ?> hover-shadow <?php endif;?>">
<div class="d-block d-md-flex  text-center align-self-center rounded overflow-hidden <?php if(is_odd($postCount)){echo('order-md-2');}?>">
		<div class="d-none d-md-block align-self-center p-2  z-4 <?php if(is_odd($postCount)){echo('order-md-2');}?>">

			<?php if($fblink != null){echo '<a href="'.$fblink.'"><img class="pt-1" height="32" width="32" src="'.$fb.'"/></a><br>';}?>
			<?php if($instalink != null){echo '<a href="'.$instalink.'"><img class="pt-1" height="32" width="32" src="'.$insta.'"/></a><br>';}?>
			<?php if($inlink != null){echo '<a href="'.$inlink.'"><img class="pt-1" height="32" width="32" src="'.$in.'"/></a><br>';}?>
			<?php if($twitlink != null){echo '<a href="'.$twitlink.'"><img class="pt-1" height="32" width="32" src="'.$twit.'"/></a><br>';}?>
			

		</div>
 		<?php the_post_thumbnail('medium', array('class' => 'physician-single-photo img-fluid img-flex')); ?>
	</div>	
	<div class="text-center p-4 col-12 col-md align-self-center <?php if(is_odd($postCount)){echo('order-md-1 text-md-right ');}else{echo('text-md-left');}?> ">
	<h4 class=" mt-0 text-secondary">
		<?php echo the_title();?>
	</h4>

	<h5 class="pt-0 mt-0 text-primary">
		<strong><?php echo ($distinct_title);?></strong>
	</h5>

	<p class="text-tertiary"><?php echo ($public_specialty);?></p>
	</div>	
<?php if ($no_link == null): ?>
	<a href="<?php the_permalink();?>" class="position-absolute t-0 l-0 r-0 b-0"></a>
	<?php endif;?>

	<div class=" col-12  d-md-none justify-content-center text-center  align-self-center p-2 ">
			<?php if($fblink != null){echo '<a href="'.$fblink.'"><img class="pt-1" height="32" width="32" src="'.$fb.'"/></a>';}?>
			<?php if($instalink != null){echo '<a href="'.$instalink.'"><img class="pt-1" height="32" width="32" src="'.$insta.'"/></a>';}?>
			<?php if($inlink != null){echo '<a href="'.$inlink.'"><img class="pt-1" height="32" width="32" src="'.$in.'"/></a>';}?>
			<?php if($twitlink != null){echo '<a href="'.$twitlink.'"><img class="pt-1" height="32" width="32" src="'.$twit.'"/></a>';}?>
	
		</div>
</div>
