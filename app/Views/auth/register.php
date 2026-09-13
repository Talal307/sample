<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        body { font-family: sans-serif; display: grid; place-content: center; height: 100vh; margin: 0; }
        form { display: flex; flex-direction: column; gap: 10px; width: 300px; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 0.9em; }
    </style>
</head>
<body>
    <h2>Create an Account</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="error">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <form action="<?= base_url('register') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= old('username') ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= old('email') ?>" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="pass_confirm">Confirm Password</label>
        <input type="password" name="pass_confirm" id="pass_confirm" required>

        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="<?= base_url('login') ?>">Sign in here</a></p>
</body>
</html>