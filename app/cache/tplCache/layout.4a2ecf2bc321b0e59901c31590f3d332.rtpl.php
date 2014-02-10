<?php if(!class_exists('Rain\Tpl')){exit;}?><html>
    <head>
        <title>php-mvc framework</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div><?php echo htmlspecialchars( $content, ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
    </body>
</html>
