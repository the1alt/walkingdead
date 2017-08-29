<!DOCTYPE html>
<html lang="{{ app()->getLocale()}}" ng-app="charactereRecords">
<head>
    <title>WalkingDead Characteres Manager</title>

    <!-- Compiled and minified CSS -->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->

    <script src="{{ asset('dist/js/bundle.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

    <!-- Angular Material Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUO9bGSDODUZfUjbtaYeuoy8VGimyhGM">
    </script>

    <!-- AngularJS Application Scripts -->
    <script src="<?= asset('app/app.js') ?>"></script>
    <script src="<?= asset('app/filters/app.filters.js') ?>"></script>
    <script src="<?= asset('app/directives/map.directives.js') ?>"></script>
    <script src="<?= asset('app/controllers/characteres.js') ?>"></script>
</head>
<body>

    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Walking Dead App</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <!--<li><a href="#/">Home</a></li>
                    <li><a href="#/contact">Contact</a></li>-->
                </ul>
            </div>
        </nav>
    </header>
    <div class="container" ng-controller="characteresController">
            <div class="row">
                <div class="col s3 m3">
                    <form action="#">
                        <p>
                            <input name="group1" ng-value="1" ng-model="characteres.sexeOption" type="radio" id="test1" />
                            <label for="test1">Homme</label>
                        </p>
                        <p>
                            <input name="group1" ng-model="characteres.sexeOption" ng-value="0" type="radio" id="test2" />
                            <label for="test2">Femme</label>
                        </p>
                        <p>
                            <input class="with-gap" ng-model="characteres.sexeOption" ng-value="null" name="group1" type="radio" id="test3"  />
                            <label for="test3">tous</label>
                        </p>
                    </form>
                </div>
                <div class="input-field col s4">
                    <label for="searchText">Rechercher avec n'importe quel mot</label>
                    <input type="text" ng-model="characteres.searchText" id="searchText">
                </div>
                <div class="col s5 m5">
                    <button id="btn-add" class="btn btn-primary btn-xs float-right" ng-click="toggle('add', 0)">Add New Charactere</button>
                </div>
            </div>
            <div class="row">
                <h5>Filtrer par Age</h5>
                <div class="col s12 m12">
                    <form action="#">
                        <p class="range-field">
                            <input type="range" ng-model="characteres.ageRange" id="test5" min="0" value="10" max="100" />
                            <span>Afficher toutes les personnes ayant un age inférieur à : <% characteres.ageRange %> ans</span>
                        </p>
                    </form>
                </div>
            </div>



        <div class="row">
            <div class="col s12 m12" id="characteres" >
                <div class="col s6 m6 block" ng-repeat="charactere in characteres | triSexe:characteres.sexeOption | searchText:characteres.searchText | ageMax:characteres.ageRange">
                    <div ng-class="{'shake':(charactere.birth_date|month)}" class="card horizontal animated" >
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" ng-src="<% charactere.photo %>" alt="<% charactere.pseudo %>" width="200px" height="276px"/>
                        </div>

                        <div class="card-stacked">
                            <div class="card-content">

                                <span class="card-title activator grey-text text-darken-4" >#<% charactere.id %> <% charactere.pseudo %><i class="material-icons right">more_vert</i></span>

                                <p><% charactere.sexe ? 'Homme' : 'Femme'%> - <% age(charactere.birth_date) %> ans - <% charactere.activity %> - <% charactere.birth_date %> - <% charactere.state %></p>

                                <p ng-if="charactere.naissance|month"><i class="material-icons">cake</i> Joyeux anniversaire !</p>

                                <a class="btn-floating btn-large waves-effect waves-light blue modal-open" id="btn-edit" ng-click="toggle('edit', charactere.id)"><i class="material-icons">edit</i></a>
                                <a class="btn-floating btn-large waves-effect waves-light red" id="btn-del" ng-click="confirmDelete(charactere.id)"><i class="material-icons">delete</i></a>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4" >#<% charactere.id %> <% charactere.pseudo %><i class="material-icons right">close</i></span>
                            <p><% charactere.sexe ? 'Homme' : 'Femme'%> - <% charactere.birth_date %> - <% charactere.activity %> - <% charactere.state %></p>
                            <p>
                                Saisons : <span ng-repeat="saison in charactere.saisons"><%saison%>.</span><br/>
                                <% charactere.resume %>
                                span
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <map characteres="characteres" coords="{lat:49.00749937, lng:2.54836031}"></map>
        </div>





    <!-- End of Table-to-load-the-data Part -->
    <!-- Modal (Pop up when detail button clicked) -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="btn-floating btn-small waves-effect waves-light red right modal-action modal-close" id="btn-close"><i class="material-icons right">close</i></a>
                    <h4 class="modal-title" id="myModalLabel"><%form_title%></h4>
                </div>
                <div class="modal-body">

                    <form name="frmCharacteres" class="form-horizontal" novalidate="">
                        <div class="row">
                            <div class="input-field col s6">
                                <input ng-model="charactere.pseudo" placeholder="pseudo" ng-required="true" id="pseudo" name="pseudo" type="text" class="validate" value="<%pseudo%>">
                                <label required for="pseudo" >Pseudo : </label>
                                <span class="help-inline" ng-show="frmCharacteres.pseudo.$invalid && frmCharacteres.pseudo.$touched">Name field is required</span>
                            </div>
                            <div class="input-field col s6">
                                <input ng-model="charactere.photo" placeholder="photo" ng-required="true" id="photo" name="photo" type="url" class="validate" value="<%photo%>">
                                <label for="photo" >Photo : </label>
                                <span class="help-inline" ng-show="frmCharacteres.photo.$invalid && frmCharacteres.photo.$touched">photo field is required</span>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input  ng-model="charactere.birth_date" ng-required="true" id="birth_date" name="birth_date" type="date" class="datepicker" value="<%birth_date%>">
                                <label for="birth_date" >Date de naissance : <% charactere.birth_date %></label>
                                <span class="help-inline" ng-show="frmCharacteres.birth_date.$invalid && frmCharacteres.birth_date.$touched">birth_date field is required</span>

                            </div>
                            <div class="input-field col s4 offset-s1">
                                <select ng-model="charactere.sexe" ng-required="true" id="sexe" name="sexe" value="<%sexe%>">
                                    <option value="" disabled selected>Quel est le sexe ?</option>
                                    <option ng-value="1">Homme</option>
                                    <option ng-value="0">Femme</option>
                                </select>
                                <span class="help-inline" ng-show="frmCharacteres.sexe.$invalid && frmCharacteres.sexe.$touched">Sexe field is required</span>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input ng-model="charactere.state" placeholder="state" ng-required="true" id="state" name="state" type="text" class="validate" value="<%state%>">
                                <label for="state" >Pays :</label>
                                <span class="help-inline" ng-show="frmCharacteres.state.$invalid && frmCharacteres.state.$touched">state field is required</span>

                            </div>
                            <div class="input-field col s3">
                                <input ng-model="charactere.latitude" placeholder="latitude" ng-required="true" id="latitude" name="latitude" step="0.000001" type="number" value="<%latitude%>" class="validate">
                                <label for="latitude" >Latitude :</label>
                                <span class="help-inline" ng-show="frmCharacteres.latitude.$invalid && frmCharacteres.latitude.$touched">latitude field is required</span>

                            </div>
                            <div class="input-field col s3">
                                <input ng-model="charactere.longitude" placeholder="longitude" ng-required="true" id="longitude" name="longitude" step="0.000001" type="number" value="<%longitude%>" class="validate">
                                <label for="longitude" >Longitude : </label>
                                <span class="help-inline" ng-show="frmCharacteres.longitude.$invalid && frmCharacteres.longitude.$touched">longitude field is required</span>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input ng-model="charactere.activity" placeholder="activity" ng-required="true" id="activity" name="activity" type="text" class="validate" value="<%activity%>">
                                <label for="activity" >Activité : </label>
                                <span class="help-inline" ng-show="frmCharacteres.activity.$invalid && frmCharacteres.activity.$touched">activity field is required</span>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12" id="checkSaison">
                                <p>
                                    Saison d'apparition :
                                </p>
                                <div class="row">
                                    <input type="checkbox" ng-model="charactere.checkSaison.saison1" value="1"  class="filled-in" id="filled-in-box1"  />
                                    <label for="filled-in-box1">1</label>
                                    <input type="checkbox" ng-model="charactere.checkSaison.saison2" value="2" class="filled-in" id="filled-in-box2"  />
                                    <label for="filled-in-box2">2</label>
                                    <input type="checkbox" ng-model="charactere.checkSaison.saison3" value="3" class="filled-in" id="filled-in-box3"  />
                                    <label for="filled-in-box3">3</label>
                                    <input type="checkbox" ng-model="charactere.checkSaison.saison4" value="4" class="filled-in" id="filled-in-box4"  />
                                    <label for="filled-in-box4">4</label>
                                    <input type="checkbox" ng-model="charactere.checkSaison.saison5" value="5" class="filled-in" id="filled-in-box5"  />
                                    <label for="filled-in-box5">5</label>
                                    <input type="checkbox" ng-model="charactere.checkSaison.saison6" value="6" class="filled-in" id="filled-in-box6"  />
                                    <label for="filled-in-box6">6</label>
                                    <input type="checkbox" ng-model="charactere.checkSaison.saison7" value="7" class="filled-in" id="filled-in-box7"  />
                                    <label for="filled-in-box7">7</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea ng-required="true" placeholder="resume" id="resume" ng-model="charactere.resume" class="materialize-textarea" value="<%resume%>"></textarea>
                                <label for="resume" >Résumé</label>
                                <span class="help-inline" ng-show="frmCharacteres.resume.$invalid && frmCharacteres.resume.$touched">Name field is required</span>

                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary modal-action modal-close" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmCharacteres.$invalid">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
            $(document).ready(function() {
                $('select').material_select();
                $('.datepicker').pickadate({
                    format : 'yyyy-mm-dd',
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 15 // Creates a dropdown of 15 years to control year
                });
            });

    </script>


</body>

</html>