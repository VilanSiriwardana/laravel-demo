<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
      <header class="border-b border-slate-200 bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
          <div>
            <p class="text-sm uppercase tracking-wider text-slate-500">Laravel 13 CRUD</p>
            <h1 class="text-xl font-semibold text-slate-900">Posts Dashboard</h1>
          </div>
          @auth
            <form action="/logout" method="POST">
              @csrf
              <button type="submit"
                class="inline-flex items-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">
                Logout
              </button>
            </form>
          @endauth
        </div>
      </header>

      <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        @auth
          <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <section class="lg:col-span-1">
              <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Create New Post</h2>
                <p class="mt-1 text-sm text-slate-500">Share a quick update with your class.</p>

                <form action="/create-post" method="POST" class="mt-5 space-y-4">
                  @csrf
                  <div>
                    <label class="text-sm font-medium text-slate-700">Title</label>
                    <input type="text" name="title" placeholder="Post Title"
                      class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                  </div>
                  <div>
                    <label class="text-sm font-medium text-slate-700">Body</label>
                    <textarea name="body" rows="6" placeholder="Body Content...."
                      class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
                  </div>
                  <button type="submit"
                    class="inline-flex w-full items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Create Post
                  </button>
                </form>
              </div>
            </section>

            <section class="lg:col-span-2">
              <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-semibold text-slate-900">All Posts</h2>
                    <p class="mt-1 text-sm text-slate-500">Your most recent posts appear here.</p>
                  </div>
                  <span
                    class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">{{ $posts->count() }}
                    total</span>
                </div>

                <div class="mt-6 space-y-4">
                  @foreach ($posts as $post)
                    <article class="rounded-lg border border-slate-200 bg-slate-50/60 p-4">
                      <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                          <h3 class="text-base font-semibold text-slate-900">{{ $post['title'] }}</h3>
                          <p class="text-xs text-slate-500">by {{ $post->user->name }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                          <a href="/edit-post/{{ $post->id }}"
                            class="inline-flex items-center rounded-md border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100">
                            Edit
                          </a>
                          <form action="/delete-post/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                              class="inline-flex items-center rounded-md border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-100">
                              Delete
                            </button>
                          </form>
                        </div>
                      </div>
                      <p class="mt-3 text-sm text-slate-700">{{ $post['body'] }}</p>
                    </article>
                  @endforeach
                </div>
              </div>
            </section>
          </div>
        @else
          <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
              <h2 class="text-lg font-semibold text-slate-900">Create an Account</h2>
              <p class="mt-1 text-sm text-slate-500">Register to start posting and editing.</p>

              <form action="/register" method="POST" class="mt-5 space-y-4">
                @csrf
                <div>
                  <label class="text-sm font-medium text-slate-700">Name</label>
                  <input type="text" name="name" placeholder="Name"
                    class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                  <label class="text-sm font-medium text-slate-700">Email</label>
                  <input type="email" name="email" placeholder="Email"
                    class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                  <label class="text-sm font-medium text-slate-700">Password</label>
                  <input type="password" name="password" placeholder="Password"
                    class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <button type="submit"
                  class="inline-flex w-full items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                  Register
                </button>
              </form>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
              <h2 class="text-lg font-semibold text-slate-900">Welcome Back</h2>
              <p class="mt-1 text-sm text-slate-500">Log in to manage your posts.</p>

              <form action="/login" method="POST" class="mt-5 space-y-4">
                @csrf
                <div>
                  <label class="text-sm font-medium text-slate-700">Name</label>
                  <input type="text" name="loginName" placeholder="Name"
                    class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <div>
                  <label class="text-sm font-medium text-slate-700">Password</label>
                  <input type="password" name="loginPassword" placeholder="Password"
                    class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <button type="submit"
                  class="inline-flex w-full items-center justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">
                  Login
                </button>
              </form>
            </section>
          </div>
        @endauth
      </main>
    </div>
  </body>

</html>
