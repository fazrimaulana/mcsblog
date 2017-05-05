@extends('layouts.Frontend.Default.app')

@section('content')

    <div class="user-profile">  

        <div class="user-info">
            <div class="wr-user-info container">
                <div class="title text-center">
                    <h1>PROFILE</h1>
                </div>
                <div class="col-md-3 col-sm-1"></div>
                <div class="content col-md-6 col-sm-10 col-xs-12">
                    <div class="user-pict text-center">
                        <img src="{{ url(Auth::user()->usermeta->image) }}">
                    </div>
                    <table class="info-detail">
                        <tr>
                            <td>
                                <p>Name </p>
                            </td>
                            <td>
                                <p>{{ Auth::user()->name }}</p>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Email </p>
                            </td>
                            <td>
                                <p>{{ Auth::user()->email }}</p>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Display Name </p>
                            </td>
                            <td>
                                <p>{{ Auth::user()->usermeta->display_name }}</p>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Api Token </p>
                            </td>
                            <td>
                                <p style="color: red;">
                                  {{ Auth::user()->api_token }}
                                </p>
                            </td>
                            <td>
                              
                              <form action="{{ url('/dashboard/users/refresh/apitoken') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-refresh"></i></button>
                              </form>

                            </td>
                        </tr>
                        <!-- <tr>
                            <td>
                                <p>Phone Number </p>
                            </td>
                            <td>
                                <p>: 0811xxxxxxx</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Gender </p>
                            </td>
                            <td>
                                <p>: Male</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Address </p>
                            </td>
                            <td>
                                <p>: Jl.Perkutut II No.5</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>City </p>
                            </td>
                            <td>
                                <p>: Bandung</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Postcode </p>
                            </td>
                            <td>
                                <p>: 112233</p>
                            </td>
                        </tr> -->
                    </table><!--END OF .INFO-DETAIL-->
                    <div class="editing text-center">
                        <a href="#">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDIT
                        </a>
                    </div>
                </div><!--END OF .CONTENT-->
                <div class="col-md-3 col-sm-1"></div>
            </div><!--END OF .WR-USER-INFO-->
        </div><!--END OF .USER-INFO-->
    </div><!--END OF .USER-PROFILE-->

@endsection