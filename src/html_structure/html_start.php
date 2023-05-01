<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if(array_key_exists('content_languate', $template_metadata)): ?>
        <meta http-equiv="Content-Language" content="<?= $template_metadata['content_language'] ?>">
    <?php endif; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <?php if(array_key_exists('title', $template_metadata)): ?>
        <title><?= $template_metadata['title'] ?></title>
    <?php endif; ?>

    <?php if(array_key_exists('description', $template_metadata)): ?>
        <meta name="description" content="<?= $template_metadata['description'] ?>">
    <?php endif; ?>

    <?php if(array_key_exists('keywords', $template_metadata)): ?>
        <meta name="keywords" content="<?= $template_metadata['keywords'] ?>">
    <?php endif; ?>

    <?php if(array_key_exists('og:url', $template_metadata)): ?>
        <meta property="og:url" content="<?= $template_metadata['og:url'] ?>">
    <?php endif; ?>

    <?php if(array_key_exists('og:type', $template_metadata)): ?>
        <meta property="og:type" content="<?= $template_metadata['og:type'] ?>">
    <?php endif; ?>
    
    <?php if(array_key_exists('og:site_name', $template_metadata)): ?>
        <meta property="og:site_name" content="<?= $template_metadata['og:site_name'] ?>">
    <?php endif; ?>

    <?php if(array_key_exists('og:title', $template_metadata)): ?>
        <meta property="og:title" content="<?= $template_metadata['og:title'] ?>">
    <?php endif; ?>

    <?php if(array_key_exists('og:description', $template_metadata)): ?>
        <meta property="og:description" content="<?= $template_metadata['og:description'] ?>">
    <?php endif; ?>
    
    <?php if(array_key_exists('css', $template_metadata)): ?>
        <?php foreach($template_metadata['css'] as $css_file_path): ?>
            <link rel="stylesheet" href="<?= $css_file_path ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if(array_key_exists('js', $template_metadata)): ?>
        <?php foreach($template_metadata['js'] as $js_file_path): ?>
            <script src="<?= $js_file_path ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if(array_key_exists('icon', $template_metadata)): ?>
        <link rel="icon" href="<?= $template_metadata['icon'] ?>" type="image/x-icon" sizes="32x32">
    <?php endif; ?>

    <?php if(array_key_exists('shortcut_icon', $template_metadata)): ?>
        <link rel="shortcut icon" href="<?= $template_metadata['shortcut_icon'] ?>" type="image/x-icon" sizes="32x32">
    <?php endif; ?>
</head>
<body>