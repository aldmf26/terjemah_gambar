<div>
    <button class="mt-2 btn btn-{{$textTo == 'en' ? 'danger' : 'warning'}}" wire:click="textTo('{{$textTo}}')">{{$label}}</button>

    <input autofocus wire:model.debounce.500ms="inputText" type="text" class="form-control border-info border-2 mt-2 text-black"
        placeholder="masukan yang ingin kamu terjemahkan">
        <div wire:loading='inputText' class="mt-2 spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
    @if (!empty($inputText))
        <h4 class="mt-2">
            {{ $terjemahan }}
        </h4>
        <img class="img-fluid mt-3" width="200" height="200" src="{{ strpos($image, 'http') !== false ? $image : asset('/uploads/' . $image) }}" alt="">
    @endif
</div>
