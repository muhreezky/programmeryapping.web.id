<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Blog Posts</h1>

        <div class="mb-4">
            <a href="{{ route('blog-posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create New Post
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600">Title</th>
                        <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600">Author</th>
                        <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600">Created At</th>
                        <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogPosts as $blogPost)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $blogPost->title }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $blogPost->author->name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $blogPost->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                <a href="{{ route('blog-posts.edit', $blogPost->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                <form action="{{ route('blog-posts.destroy', $blogPost->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>