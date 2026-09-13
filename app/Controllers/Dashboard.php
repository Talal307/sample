<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Dashboard extends BaseController
{
    public function index()
    {
if (! session()->has('user_id')) {
        return redirect()->to('login');

    }

    $blogModel = new BlogModel();
    $blogs = $blogModel->findAll();

    

    $data = [
        'username' => session()->get('username'),
        'blogs'    => $blogs,
    ];

    return view('dashboard', $data);
    }

    public function create()
    {
        if (! session()->has('user_id')) {
            return redirect()->to('login');
        }

        $rules = [
            'content' => 'required|min_length[5]|max_length[2000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $blogModel = new BlogModel();

        $blogModel->save([
            'user_id'     => session()->get('user_id'),
            'author_name' => session()->get('username'),
            'content'     => $this->request->getPost('content'),
        ]);

        return redirect()->to('dashboard')->with('success', 'Blog posted successfully!');
    }
    public function edit($id)
{
    if (! session()->has('user_id')) {
        return redirect()->to('login');
    }

    $blogModel = new BlogModel();
    $blog = $blogModel->find($id);

    
    if (! $blog || $blog['user_id'] != session()->get('user_id')) {
        return redirect()->to('dashboard')->with('errors', ['Unauthorized access or post not found.']);
    }

    return view('edit_blog', ['blog' => $blog]);
}

public function update($id)
{
    if (! session()->has('user_id')) {
        return redirect()->to('login');
    }

    $blogModel = new BlogModel();
    $blog = $blogModel->find($id);

    if (! $blog || $blog['user_id'] != session()->get('user_id')) {
        return redirect()->to('dashboard')->with('errors', ['Unauthorized action.']);
    }

    $rules = [
        'content' => 'required|min_length[5]|max_length[2000]',
    ];

    if (! $this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $blogModel->update($id, [
        'content' => $this->request->getPost('content'),
    ]);

    return redirect()->to('dashboard')->with('success', 'Post updated successfully!');
}

public function delete($id)
{
    if (! session()->has('user_id')) {
        return redirect()->to('login');
    }

    $blogModel = new BlogModel();
    $blog = $blogModel->find($id);

    if (! $blog || $blog['user_id'] != session()->get('user_id')) {
        return redirect()->to('dashboard')->with('errors', ['Unauthorized action.']);
    }

    $blogModel->delete($id);

    return redirect()->to('dashboard')->with('success', 'Post deleted successfully!');
}
}
