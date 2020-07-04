<div>
    <div>

        <div>
            <div>
                <label>Midi File</label>
                <input type="file" name="" accept="audio/midi"
                       wire:change="input($event)">
            </div>
            <div>
                <div>
                    @foreach ($colors as $color)
                    <input type="color" value="{{ $color }}">
                    @endforeach

                </div>
                <div>
                    <button type="button" wire:click="addColor">+</button>
                    <button type="button" {{ count($colors) <= 2 ? 'disabled' : '' }} wire:click="subColor"> -</button>
                    <button type="button" wire:click="randomGradient">Random
                        Gradient</button>
                </div>
                <div>
                    <label>Fill Opacity</label>
                    {{-- <input type="range" v-model="fillOpacity" min="10" max="100" step="5">
                    {{ fillOpacity / 100 }} --}}
                </div>
            </div>
            <button type="button" wire:click="submit">Submit</button>
        </div>
        <div v-html="svg">
        </div>
    </div>
</div>
