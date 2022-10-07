<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <?php if(array_key_exists('title', $template_metadata)): ?>
        <title><?= $template_metadata['title'] ?></title>
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