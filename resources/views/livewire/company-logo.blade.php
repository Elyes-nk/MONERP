<div class="container-fluid">
            <form class="form-neon" autocomplete="off" wire:submit.prevent="AddImage">
                    <fieldset>
                        <legend><i class="far fa-plus-square"></i> &nbsp; Logo de la compagnie</legend>
                        <!--affichage image -->
                        @if($image)
                            <img src="{{$image}}" width="200">
                        @else
                            @if($company->logo)
                                <img src="{{'../storage/'.$company->logo }}" width="200">
                            @endif
                        @endif
                        <!-- input image -->
                        <section>
                            <input type="file" id="image" 
                            wire:change="$emit('fileChoosen')">
                        </section>
                    </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                 <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; ENREGISTRER</button>
                </p>
             </form>
</div>