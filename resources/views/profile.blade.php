<x-app-layout>
    <x-container>
    <form action="{{ route('friends.store', $user) }}" class='px-4 mb-8' method="POST">
     @csrf
     <input type='submit'
     class="px-4 py-2 bg-yellow-400 text-gray-800 font-semibold rounded-md hover:bg-yellow-500 transition-colors duration-200"
     value="Add Friend" 
    />
    </form>
  
  
   @foreach($posts as $posts)
  
  <x-card class='mb-4'>
  {{ $posts->body }}
  <div class='text-xs text-slate-500'>
  
    {{ $posts->created_at->diffForHumans() }}
  </div>
  
  </x-card>
  @endforeach
    
    </x-container>
                
  </x-app-layout>
  