<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Proyecto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>
<body>
    <?php include 'layout/header.php'; ?>

    <main class="content-app">
        <?php include $view; ?>
    </main>

    <?php include 'layout/footer.php'; ?>
</body>

<style>
    .content-app{
        height: auto;
        min-height: 72vh;
    }
</style>

</html>