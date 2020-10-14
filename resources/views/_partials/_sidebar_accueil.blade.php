<section class="full-box nav-lateral">
    <div class="full-box nav-lateral-bg show-nav-lateral"></div>
    <div class="full-box nav-lateral-content">
        <figure class="full-box nav-lateral-avatar">
            <i class="far fa-times-circle show-nav-lateral"></i>
            <img src="/storage/{{Auth::user()->image}}" class="img-fluid" alt="Avatar">
            <figcaption class="roboto-medium text-center">
                {{ Auth::user()->name }}<br><small class="roboto-condensed-light">{{ Auth::user()->role }}</small>
            </figcaption>
        </figure>
        <div class="full-box nav-lateral-bar"></div>
        <nav class="full-box nav-lateral-menu">
            <ul>
                <li>
                    <a href="/home"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Accueil</a>
                </li>
                <li>
                    <a href="#" class="nav-btn-submenu"><i class="fas fa-shopping-cart fa-fw"></i> &nbsp; Achats <i class="fas fa-chevron-down"></i></a>
                        <ul>
                            @if(Auth::user()->role == 'Financier' OR Auth::user()->role ==  'Administrateur')
                            <li>
                                <a href="{{ route('devis.index') }}"><i class="fas fa-clipboard fa-fw"></i> &nbsp;Devis</a>
                            </li>
                            @endif
                            <li>
                            <a href="{{ route('commandes.index') }}"><i class="fas fa-clipboard fa-fw"></i> &nbsp;Bons de commande</a>
                            </li>
                            <li>
                            <a href="{{ route('receptions.index')}}"><i class="fas fa-clipboard-check fa-fw"></i> &nbsp;Bons de réception</a>
                            </li>
                            <li>
                            <a href="{{ route('retour.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp;Bons de retour</a>
                            </li>
                            @if(Auth::user()->role == 'Financier' OR Auth::user()->role ==  'Administrateur')
                            <li>
                                    <a href="{{ route('bills.index') }}"><i class="fas fa-money-check-alt fa-fw"></i> &nbsp; Factures</a>
                            </li>
                            @endif
                            @if(Auth::user()->role == 'Financier' OR Auth::user()->role ==  'Administrateur')
                            <li>
                                        <a href="#" class="nav-btn-submenu"><i class="fas fa-edit"></i> &nbsp; Paramètres <i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                                <li>
                                                    <a href="{{ route('taxes.index') }}" ><i class="fas fa-hand-holding-usd fa-fw"></i> &nbsp; Taxes</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('currencies.index') }}"><i class="fas fa-money-bill-wave fa-fw"></i> &nbsp; Devises</a>
                                                </li>
                                         </ul>
                            </li>
                            @endif
                        </ul>
                </li>
                <li>
                    <a href="#" class="nav-btn-submenu"><i class="fas fa-box-open"></i> &nbsp; Articles <i class="fas fa-chevron-down"></i></a>
                    <ul>
                         <li>
                            <a href="{{ route('products.index') }}"><i class="fas fa-box-open"></i> &nbsp; Liste des articles</a>
                        </li>
                        <li>
                            <a href="{{ route('stock.index') }}"><i class="fas fa-cubes fa-fw"></i> &nbsp; Stock</a>
                        </li>
                        <li>
                               <a href="#" class="nav-btn-submenu"><i class="fas fa-edit"></i> &nbsp; Paramètres <i class="fas fa-chevron-down"></i></a>
                               <ul>
                                  <li>
                                  <a href="{{ route('unityProducts.index') }}"><i class="fas fa-balance-scale-right fa-fw"></i> &nbsp; Unités de produit</a>
                                  </li>
                                  <li>
                                  <a href="{{ route('categoryProducts.index') }}"><i class="fas fa-cube fa-fw"></i> &nbsp; Catégories de produit</a>
                                  </li>
                               </ul>
                        </li>

                    </ul>
                </li>
                @if(Auth::user()->role == 'Magasinier' OR Auth::user()->role ==  'Administrateur')
                <li>
                    <a href="#" class="nav-btn-submenu"><i class="fas fa-warehouse"></i> &nbsp; Entrepôts <i class="fas fa-chevron-down"></i></a>
                    <ul>
                         <li>
                            <a href="{{ route('warehouses.index') }}"><i class="fas fa-warehouse"></i> &nbsp; Liste des entrepôts</a>
                        </li>
                        <li>
                            <a href="{{ route('replenishment.index') }}"><i class="fas fa-file-download fa-fw"></i> &nbsp; Réaprovisionnements</a>
                        </li>
                        <li>
                            <a href="{{ route('replenishmentRules.index') }}"><i class="fas fa-file-invoice fa-fw"></i> &nbsp; Planifications de réaprovisionnement</a>
                        </li>
                        <li>
                            <a href="{{ route('replenishmentRules.index') }}" data-target="#exampleModalluanchrep" data-toggle="modal"><i class="fas fa-file-invoice fa-fw"></i> &nbsp; Lancer les réaprovisionnements</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->role == 'Financier' OR Auth::user()->role ==  'Administrateur')
                <li>
                    <a href="#" class="nav-btn-submenu"><i class="fas fa-truck"></i> &nbsp; Fournisseurs <i class="fas fa-chevron-down"></i></a>
                    <ul>
                         <li>
                            <a href="{{ route('tiers.index')}}"><i class="fas fa-truck fa-fw"></i> &nbsp; Liste des fournisseurs</a>
                        </li>
                        <li>
                               <a href="#" class="nav-btn-submenu"><i class="fas fa-edit"></i> &nbsp; Paramètres <i class="fas fa-chevron-down"></i></a>
                               <ul>
                                    <li>
                                    <a href="{{ route('listPrices.index')}}"><i class="fas fa-file-invoice-dollar fa-fw"></i> &nbsp; Liste de prix</a>
                                    </li>
                               </ul>
                         </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->role == 'Administrateur')
                <li>
                    <a href="#" class="nav-btn-submenu"><i class="far fa-building"></i> &nbsp; Société <i class="fas fa-chevron-down"></i></a>
                    <ul>
                         <li>
                         <a href="/company/{{Auth::user()->company->id}}"><i class="far fa-building"></i> &nbsp;  Ma société</a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"><i class="fas fa-users"></i> &nbsp; Utilisateurs</a>
                        </li>
                        <li>
                            <a href="#" class="nav-btn-submenu"><i class="fas fa-edit"></i> &nbsp; Paramètres <i class="fas fa-chevron-down"></i></a>
                            <ul>
                               <li>
                               <a href="{{ route('sequences.index') }}"><i class="fas fa-paperclip fa-fw"></i> &nbsp; Séquences</a>
                               </li>
                            </ul>
                     </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>

</section>

