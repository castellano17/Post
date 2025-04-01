<x-app-layout>
    <x-container>
    <form action="{{ route('friends.store', $user) }}" class='px-4 mb-8' method="POST">
     @csrf
     <x-submit-button>Add friend</x-submit-button>
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
  