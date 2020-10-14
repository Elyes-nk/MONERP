<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <form>
                    <div class="input-group">
                    <input type="text" wire:model="name" class="form-control"  placeholder="Recherche">                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </li>
            <li>
                <div class="row">
                <div class="col-md-6">
                    Afficher
                </div>
                <div class="col-md-6">
                <select id="sk" class="form-control" wire:model.lazy="pages">
                    <?php
                    $i=10;
                    while($i<=50){

                        ?>
                        <option value="{{$i }}">{{ $i}}</option>
                <?php
                $i=$i+10;
                }  ?>
                </select>
                </div>
                </div>
            </li>
        </ul>
    </div>

    <!--CONTENT-->
   <div class="container-fluid">
        <div class="table-responsive">
            <div class="d-flex justify-content-center" >
                <div class="spinner-border" wire:loading >
                  <span class="sr-only" >Chargement...</span>
                </div>
              </div>
            <table class="table table-dark table-sm" wire:loading.remove>
                <thead>
                    <tr class="text-center roboto-medium">

                        <th>Numéro</th>
                        <th>Date </th>
                        <th>Article</th>
                        <th>Quantité</th>
                        <th>Entrepôt</th>
                        <th>État</th>
                        <th>Message</th>

                    </tr>
                </thead>
                <tbody>
                    @if (count($replenishments)==0)
                    <tr>
                        <td colspan="7">Pas de réapprovisionnements disponnible</td>
                        </tr>
                    @else
                        @foreach ($replenishments as $replenishment)
                        <tr class="text-center" @if ($replenishment->state=='En exception')
                                style="color:red"
                        @endif>

                        <td  onclick="document.location='/replenishment/{{$replenishment->id}}'">{{ $replenishment->name }}</td>
                        <td  onclick="document.location='/replenishment/{{$replenishment->id}}'">{{ $replenishment->date }}</td>
                        <td  onclick="document.location='/replenishment/{{$replenishment->id}}'">{{ $replenishment->product->name }}</td>
                        <td  onclick="document.location='/replenishment/{{$replenishment->id}}'">{{ $replenishment->product_qty }}</td>
                        <td  onclick="document.location='/replenishment/{{$replenishment->id}}'">{{ $replenishment->warehouse->name }}</td>
                        <td  onclick="document.location='/replenishment/{{$replenishment->id}}'">{{ $replenishment->state }}</td>
                        <td  onclick="document.location='/replenishment/{{$replenishment->id}}'">{{ $replenishment->message }}</td>

                        </tr>
                        @endforeach
                        @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6 center mx-auto">
        {{ $replenishments->links() }}
    </div>
</div>

@section('jsnagh')
@foreach($replenishments as $replenishment)
<script>
$("#exampleModal{{$replenishment['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$replenishment['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
