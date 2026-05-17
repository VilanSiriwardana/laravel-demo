<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
      <header class="border-b border-slate-200 bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-3xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
          <div>
            <p class="text-sm uppercase tracking-wider text-slate-500">Edit Post</p>
            <h1 class="text-xl font-semibold text-slate-900">Update your post</h1>
          </div>
          <a href="/"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">
            Back to Home
          </a>
        </div>
      </header>

      <main class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
          <form action="/edit-post/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
              <label class="text-sm font-medium text-slate-700">Title</label>
              <input type="text" name="title" value="{{ $post->title }}"
                class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div>
              <label class="text-sm font-medium text-slate-700">Body</label>
              <textarea name="body" rows="8" placeholder="Body Content...."
                class="mt-1 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ $post->body }}</textarea>
            </div>
            <div>
              <p class="text-sm font-medium text-slate-700">Current Image</p>
              <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                class="mt-1 h-56 w-full rounded-md object-cover">
            </div>
            <div>
              <label class="text-sm font-medium text-slate-700">Image</label>
              <div class="flex space-x-4">
                <input type="file" name="image"
                  class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
              </div>

            </div>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
              <button type="submit"
                class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                Update Post
              </button>
              <a href="/"
                class="inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">
                Cancel
              </a>
            </div>
          </form>
        </div>
      </main>
    </div>
  </body>

</html>
