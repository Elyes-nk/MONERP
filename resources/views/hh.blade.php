@extends('layouts.base')
@section('you')


<nav class="nav nav-tabs">
    <a class="nav-item nav-link active  jj" href="#accueil">Accueil</a>
    <a class="nav-item nav-link jj" href="#livres">Livres</a>
    <a class="nav-item nav-link jj" href="#temoignages">Témoignages</a>
  </nav>

  <div class="tab-content">
      <div class="tab-pane active" id="accueil">Texte d'accueil</div>
      <div class="tab-pane" id="livres">Tous les livres</div>
      <div class="tab-pane" id="temoignages">Tous les témoignages</div>
  </div>

  <hr>
  <p><strong>Onglet actif </strong>: <span id='actif'></span></p>
  <p><strong>Onglet précédent </strong>: <span id='precedent'></span></p>
<script>
 $('.jj').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
@endsection
