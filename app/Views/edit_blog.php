<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>

    <?php $blog = $blog ?? ['id' => null, 'content' => '']; ?>

    <h2>Edit Your Post</h2>
    <p><a href="<?= base_url('dashboard') ?>">Back to Dashboard</a></p>

    <hr>

    <?php if (session()->getFlashdata('errors')): ?>
        <div>
            <?php foreach ((array) session()->getFlashdata('errors') as $error): ?>
                <p><strong>Error:</strong> <?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= isset($blog['id']) ? base_url('dashboard/update/' . $blog['id']) : base_url('dashboard') ?>" method="post">
        <?= csrf_field() ?>
        <div>
            <textarea name="content" rows="5" cols="50" required><?= esc(old('content', $blog['content'] ?? '')) ?></textarea>
        </div>
        <br>
        <button type="submit">Save Changes</button>
    </form>

</body>
</html>