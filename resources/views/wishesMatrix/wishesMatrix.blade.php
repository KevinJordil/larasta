<!-- ///////////////////////////////////              -->
<!-- Benjamin Delacombaz                              -->
<!-- Wishes Matrix layout                             -->
<!-- Version 0.3                                      -->
<!-- Created 18.12.2017                               -->
<!-- Last edit 09.01.2017 by Benjamin Delacombaz      -->


@extends ('layout')

@section ('content')
    <div class="alert-info hidden">
        <!-- Info if user doesn't have the good right -->
    </div>
    <h1>Matrice des souhaits</h1>
    <table id="WishesMatrixTable" class="table-bordered col-md-9">
        <tr>
            <th></th>
            <!-- Add each persons where initials is ok -->
            @foreach ($persons as $person)
                @if ($person->initials!="")
                    <!-- Add access class for authoized to edit a col -->
                    @if ($person->initials == $currentUser->getInitials()) 
                        <th class="access" value="{{ $person->id }}">{{ $person->initials }}</th>
                    @else
                        <th value="{{ $person->id }}">{{ $person->initials }}</th>   
                    @endif
                @endif
            @endforeach
        </tr>
        @foreach ($companies as $companie)
            <tr>
                <td value="{{ $companie->id }}">{{ $companie->companyName }}</td>
                <!-- Create the clickable case for each person -->
                @foreach ($persons as $person)
                    @if ($person->initials!="")
                    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!PROBLEM BECAUSE NOT EMPTY BECAUSE LARAVEL ADD SYNTAX IN TD !!!!!!!!!!!!!!!!!!!!!! -->
                        <td class="clickableCase">
                        <!-- Add for each persons in the table her wish -->
                            @foreach ($wishes[$person->id] as $wish)
                                <!-- if wish company is equal to the current company display the rank -->
                                @if($wish->id == $companie->id)
                                    {{ $wish->rank }}
                                @endif
                            @endforeach
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
    <a href="/traveltime/{{$flockId}}/load" class="col-md-3">Travel time</a>
@stop

@section ('page_specific_js')
    <script src="/js/wishesMatrix.js"></script>
@stop