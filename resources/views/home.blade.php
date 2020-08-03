@extends('layouts.app')

@section('content')


<div id="contenu">
<div id="contenuLeft">
    <div class="containerBtn">
    </div>
        <div id="liste_places">
        @foreach ($places as $item)
            <div class='place_card' id="{{$item->id}}">
                <div class='place_card_img' >

                <img class="fit-picture" src="uploads/place/<?php echo $item->img ?>">

                    <h4>{{  $item->img }}</h4>
                </div>
                <div class='place_card_text'>
                    
                    <div class="place_card_info">
                        <h4 class="placeName">{{ $item->name}}</h4>
                        <p class="adresse">{{ $item->adr}}</p>
                        <p class="type"> Type : {{ $item->type}}</p>

                    </div>
                    <div class="place_card_interactive">
                        <div class="completed">
                        </div>
                        <div class="button-interactive">
                            <?php 

                                $passage = 0;
                                foreach($places_completed as $com){
                                    if ($item->id == $com->id){
                                    echo "<button type='button' class='btn btn-success fait'>Fait</button>";
                                    $passage++;
                                }
                                }
                                if($passage == 0)
                                echo "<button type='button' class='btn btn-outline-success nonfait'>Fait</button>";
                                
                                $passage = 0;
                                foreach($places_favorite as $fav){
                                    if ($item->id == $fav->id){
                                        $passage++;
                                        echo "<button type='button' class='btn btn-warning fav'>Fav</button>";
                                    }
                                }
                                if($passage == 0)
                                echo "<button type='button' class='btn btn-outline-warning nonfav'>Fav</button>";
        
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        

        </div>
    </div>
    <div id="map"> 
    </div>
    <!-- Script JS -->
    <script src="{{ asset('js/map.js') }}"></script>
</div>



</html>
@endsection
