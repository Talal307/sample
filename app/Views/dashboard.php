<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h2>Welcome, <?= esc($username ?? 'User') ?></h2>
    <p><a href="<?= base_url('logout') ?>">Log Out</a></p>

    <hr>

    <?php if (session()->getFlashdata('errors')): ?>
        <div>
            <?php foreach ((array) session()->getFlashdata('errors') as $error): ?>
                <p style="color: red;"><strong>Error:</strong> <?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    
    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><strong>Success:</strong> <?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <!-- Post Creation Form -->
    <h3>Create a Post</h3>
    <form action="<?= base_url('dashboard/create') ?>" method="post">
        <?= csrf_field() ?>
        <div>
            <textarea name="content" rows="4" cols="50" placeholder="Write something..." required><?= old('content') ?></textarea>
        </div>
        <br>
        <button type="submit">Publish</button>
    </form>

    <hr>

    
    <h3>Community Feed</h3>

    <?php if (! empty($blogs) && is_iterable($blogs)): ?>
        <?php foreach ($blogs as $blog): ?>
            <?php
                $id       = is_array($blog) ? $blog['id'] : $blog->id;
                $authorId = is_array($blog) ? $blog['user_id'] : $blog->user_id;
                $author   = is_array($blog) ? ($blog['author_name'] ?? 'Member') : ($blog->author ?? 'Member');
                $date     = is_array($blog) ? ($blog['created_at'] ?? '') : ($blog->created_at ?? '');
                $body     = is_array($blog) ? ($blog['content'] ?? '') : ($blog->content ?? '');
            ?>
            <div>
                <h4><?= esc($author) ?><?= !empty($date) ? ' - ' . esc($date) : '' ?></h4>
                <p><?= nl2br(esc($body)) ?></p>

                <!-- Show Edit & Delete only to the author -->
                <?php if (session()->get('user_id') == $authorId): ?>
                    <p>
                        <a href="<?= base_url('dashboard/edit/' . $id) ?>">Edit</a>
                        |
                        <form action="<?= base_url('dashboard/delete/' . $id) ?>" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            <?= csrf_field() ?>
                            <button type="submit">Delete</button>
                        </form>
                    </p>
                <?php endif; ?>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts yet.</p>
    <?php endif; ?>

</body>
</html>