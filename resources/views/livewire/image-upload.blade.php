<div class="p-4 border rounded">
    <h2 class="mb-4">
        Upload an Image
    </h2>

    @if (session()->has('message'))
    <div class="text-green-600">
        {{session( 'message')}}
    </div>
    @endif

    <form wire:submit.prevent="Save" class="space-y-4">

    <div>
        <!-- File Input -->
        <input type="file" wire:model="image"
         class="border p-2 w-full">

         @error('image')
         <span class="text-red-500">
            {{$message}}
         </span>
         @enderror
         <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded h-6 overflow-hidden">
        <div class="h-full bg-blue-500 transition-all
         duration-500"
         style="width:{{$progress}}%;"

         >  </div>

        </div>

        <button type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded"
        {{$progress === 100 ? 'disabled' : ''}}
        >
    Upload

    </button>




    </div>

</form>

</div>
