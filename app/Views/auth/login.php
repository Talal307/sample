<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <style>
        body { font-family: sans-serif; display: grid; place-content: center; height: 100vh; margin: 0; }
        form { display: flex; flex-direction: column; gap: 10px; width: 300px; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 0.9em; }
    </style>
</head>
<body>
    <h2>Sign In now</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="error"><p><?= esc(session()->getFlashdata('error')) ?></p></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= old('email') ?>" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Log In</button>
    </form>
    <p>Don't have an account? <a href="<?= base_url('register') ?>">Sign up here</a></p>
</body>
</html>