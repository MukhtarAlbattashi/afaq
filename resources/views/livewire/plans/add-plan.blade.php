<div>
    <div class="container">
        <div class="col-md-1 mb-5">
            <button wire:click="add" class="btn btn-purble">add</button>
        </div>

        <div class="row">
            @foreach($plans as $index => $plan)
            <div class="col-md-12">
                <input wire:model="plans.{{$index}}.objective" type="text" name="objective" id="objective">
                @error('plans.' . $index . 'objective')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <input wire:model="plans.{{$index}}.strategy" type="text" name="strategy" id="strategy">
                @error('plans.' . $index . 'strategy')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <input wire:model="plans.{{$index}}.method" type="text" name="method" id="method">
                @error('plans.' . $index . 'method')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            @endforeach
            <div class="col-md-1">
                <button class="btn btn-success">save</button>
            </div>
        </div>
    </div>
</div>