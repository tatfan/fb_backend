<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $news['title'] ?></title>
<script src="/public/web/js/html5media.min.js"></script>
</head>

<body>
<?php echo $news['title'] ?>
<br /><br />
<?php echo htmlspecialchars_decode($news['content']) ?>
</body>
</html>