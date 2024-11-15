<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')
                <!-- Main Content -->
                <div class="p-4">
                    <div class="flex justify-between items-center my-4"> 
                            <h1 class="text-xl font-semibold ">User List</h1>
                            <a href="{{ route('admin.users.create') }}" 
                            class="block bg-green-500 px-4 py-2 rounded-md {{ request()->routeIs('admin.users.create') ? 'bg-gray-200' : 'hover:bg-green-400' }}">
                                Create User
                            </a>
                    </div>
                    <div class="mb-4">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                    
                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">Name</th>
                                <th class="py-2 px-4 border-b">Email</th>
                                <th class="py-2 px-4 border-b">Export</th>
                                 <th class="py-2 px-4 border-b">Import</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                <td><form id="permissions-form-{{ $user->id }}" action="{{ route('admin.users.updatePermission') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="checkbox" name="permissions[export]" value="1" 
                                            {{ $user->can_export ? 'checked' : '' }}
                                            onchange="document.getElementById('permissions-form-{{ $user->id }}').submit()">
                                        </form>
                                </td>
                            <td class="py-2 px-4 border-b text-center">
                                <input type="checkbox" form="permissions-form-{{ $user->id }}" 
                                       name="permissions[import]" value="1" 
                                       {{ $user->can_import ? 'checked' : '' }}
                                       onchange="document.getElementById('permissions-form-{{ $user->id }}').submit()">
                            </td>
                                <td class="py-2 px-4 border-b flex items-center ">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                          </svg>
                                     </a>
                                     <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" 
                                        onsubmit=" return confirm('Are you sure you want to delete this user?');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="text-red-500 hover:underline ml-2 mt-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                 <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                             </svg>
                                         </button>
                                     </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<style>
    #success-message, #error-message {
        transition: opacity 0.5s ease-out;
    }
</style>
<script>
    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            successMessage.style.opacity = '0';
        }
        if (errorMessage) {
            errorMessage.style.opacity = '0';
        }
    }, 4500);

    setTimeout(() => {
        if (successMessage) successMessage.style.display = 'none';
        if (errorMessage) errorMessage.style.display = 'none';
    }, 3000); 
</script>
