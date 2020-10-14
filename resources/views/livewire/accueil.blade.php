<div class="full-box tile-container">
                @if(Auth::user()->role == 'Financier' OR Auth::user()->role ==  'Administrateur')
				<a href="{{ route('devis.index') }}" class="tile">
					<div class="tile-tittle">Commandes</div>
					<div class="tile-icon">
                        <div><h1>{{$Devis}}</h1> </div>
                        <p><i class="fas fa-clipboard fa-fw"></i> Brouillons</p>
                    </div>
				</a>
                <a href="{{ route('commandes.index') }}" class="tile">
					<div class="tile-tittle">Commandes</div>
					<div class="tile-icon">
                        <div><h1 style="color:#ec5252;">{{$Commandes}}</h1> </div>
                        <p style="color:#ec5252;"><i class="fas fa-clipboard fa-fw"></i> En retards</p>
                    </div>
				</a>
				@endif
				<a href="{{ route('receptions.index')}}" class="tile">
                        <div class="tile-tittle">Réceptions</div>
                        <div class="tile-icon">
                            <div><h1>{{$Reception}}</h1> </div>
                            <p><i class="fas fa-clipboard-check fa-fw"></i> En attentes</p>
                        </div>
				</a>
                <a href="{{ route('receptions.index')}}" class="tile">
                        <div class="tile-tittle">Réceptions</div>
                        <div class="tile-icon">
                            <div><h1 style="color:#ec5252;">{{$ReceptionRetard}}</h1> </div>
                            <p style="color:#ec5252;"><i class="fas fa-clipboard-check fa-fw"></i> En retards</p>
                        </div>
				</a>
                @if(Auth::user()->role == 'Financier' OR Auth::user()->role ==  'Administrateur')
				<a href="{{ route('bills.index') }}" class="tile">
					<div class="tile-tittle">Factures</div>
					<div class="tile-icon">
                        <div><h1>{{$Bills}}</h1> </div>
						<p><i class="fas fa-money-check-alt fa-fw"></i>  Brouillons</p>
					</div>
				</a>
                <a href="{{ route('bills.index') }}" class="tile">
					<div class="tile-tittle">Factures</div>
					<div class="tile-icon">
                        <div><h1 style="color:#ec5252;">{{$BillsEcheance}}</h1> </div>
						<p style="color:#ec5252;"><i class="fas fa-money-check-alt fa-fw"></i>  En échéances</p>
					</div>
				</a>
                @endif
                @if(Auth::user()->role == 'Magasinier' OR Auth::user()->role ==  'Administrateur')
				<a href="{{ route('replenishment.index') }}" class="tile">
					<div class="tile-tittle">Réaprovisionement</div>
					<div class="tile-icon">
                        <div><h1 style="color:#ec5252;">{{$Replinishment}}</h1> </div>
						<p style="color:#ec5252;"><i class="fas fa-file-download fa-fw"></i> En exceptions</p>
					</div>
				</a>
                @endif
			</div>
