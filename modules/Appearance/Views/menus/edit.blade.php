@extends('layouts.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/fontawesome-iconpicker-1.3.0/dist/css/fontawesome-iconpicker.min.css') }}">

@endsection

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-th" aria-hidden="true"></i> Menus
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </div>
        @endif

        	<!--.CONTENT-NEW-USER-->
        <div class="content-ui-element">

            <div class="col-md-5 col-sm-5 col-xs-5">
                
                <form method="post" autocomplete="off" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="Status">Status Menu</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">--Select--</option>
                            <option value="1" @if($frontmenu->parent_id==null) selected @endif >Parent Menu</option>
                            <option value="0" @if($frontmenu->parent_id!=null) selected @endif >Child Menu</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="Menu Id">Menu Id</label>
                        <input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="Enter Menu Id" value="{{ $frontmenu->menu_id }}" >
                    </div>
                    <div class="form-group" @if($frontmenu->parent_id==null) style="display: none;" @endif id="parent-group">
                        <label for="Parent Id">Parent</label>
                        <select name="parent_id" class="form-control" id="parent_id" >
                            <option value="">--Select--</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->menu_id }}" @if($frontmenu->parent_id==$parent->menu_id) selected @endif >{{ $parent->name }}</option>}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Page">Page</label>
                        <select name="page" class="form-control page" id="page">
                                <option value="">--Select--</option>
                            @foreach($pages as $page)
                               <option value="{{ $page->id }}" data-slug="{{ $page->slug }}" @if($frontmenu->page_id==$page->id) selected @endif >{{ $page->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $frontmenu->name }}">
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="Href">Href</label>
                        <input type="text" class="form-control" id="href" name="href" placeholder="Enter Href" readonly value="{{ $frontmenu->href }}">
                    </div>
                    <div class="form-group">
                        <label for="Name">Target</label>
                        <select name="target" class="form-control">
                            <option value="">--Select--</option>
                            <option value="_blank" @if($frontmenu->target=="_blank") selected @endif >_blank</option>}
                            <option value="_self" @if($frontmenu->target=="_self") selected @endif >_self</option>}
                            <option value="_parent" @if($frontmenu->target=="_parent") selected @endif >_parent</option>
                            <option value="_top" @if($frontmenu->target=="_top") selected @endif >_top</option>
                        </select>                         
                    </div>
                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ $frontmenu->title }}">
                    </div>
                    <div class="form-group">
                        <label for="Icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Enter Icon" value="{{ $frontmenu->icon }}" >
                    </div>
                    <!-- <div class="form-group">
                        <label for="Module">Module</label>
                        <input type="text" class="form-control" id="module" name="module" placeholder="Enter Module">
                    </div>
                    <div class="form-group">
                        <label for="Permission">Permission</label>
                        <input type="text" class="form-control" id="permission" name="permission" placeholder="Enter Permission">
                    </div>
                    <div class="form-group">
                        <label for="Sequence">Sequence</label>
                        <input type="text" class="form-control" id="sequence" name="sequence" placeholder="Enter Sequence">
                    </div> -->
                    <button type="submit" class="btn btn-4">Update</button>
                </form>
                
            </div>

            <div class="col-md-7 col-sm-7 col-xs-7">
                
                <div class="panel-custom">
                    <!-- <div class="heading-1">
                        <h3>Menus</h3>
                    </div> -->
                    <div class="panel-body-custom">                
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Href</th>
                                        <th>Permission</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        use Modules\Appearance\Models\Frontmenu;
                                    @endphp

                                    @foreach($frontmenus as $menu)

                                        <tr>
                                            <td>
                                                {{ $menu->name }}
                                                <hr>
                                                <a href="{{ url('/dashboard/menus/'.$menu->id.'/edit') }}">Edit</a>
                                                |
                                                <a href="javascript:;" class="delete" data-id="{{ $menu->id }}" style="color: red;">Delete</a>
                                            </td>
                                            <td>{{ $menu->href }}</td>
                                            <td>{{ $menu->permission }}</td>
                                        </tr>

                                        @php
                                            $menusChild = Frontmenu::where('parent_id', $menu->menu_id)->get();
                                        @endphp

                                        @foreach($menusChild as $menuChild)

                                            <tr>
                                                <td>
                                                    __{{ $menuChild->name }}
                                                    <hr>
                                                    <a href="{{ url('/dashboard/menus/'.$menuChild->id.'/edit') }}">Edit</a>
                                                    |
                                                    <a href="javascript:;" class="delete" data-id="{{ $menuChild->id }}" style="color: red;">Delete</a>
                                                </td>
                                                <td>{{ $menuChild->href }}</td>
                                                <td>{{ $menuChild->permission }}</td>
                                            </tr>

                                        @endforeach

                                    @endforeach

                                </tbody>
                            </table>

                            {{ $frontmenus->render() }}

                        </div>
                    </div>
                </div>

            </div>

        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

        <div class="modal fade bs-example-modal-sm" id="modalDeleteMenu" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Menu</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/menus/delete') }}" id="formDeleteMenu" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="id" class="form-control" id="id">
                            <p><b>Yakin ingin menghapus menu ini ???</b></p>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('javascript')
    
    <script type="text/javascript" src="{{ url('/backend/assets/fontawesome-iconpicker-1.3.0/dist/js/fontawesome-iconpicker.js') }}"></script>

    <script type="text/javascript">
        
        $('#icon').iconpicker();

        function convertToSlug(Text)
        {
            return Text.toLowerCase().replace(/ /g,'_').replace(/[^\w-]+/g,'');
        }

        $('#status').on('change', function(){

            var status = $(this).val();

            if (status==1) {
                $('#parent-group').hide();
                $('#menu_id').val("frontmenu." + convertToSlug( $('#name').val() ) ).prop("readonly", true);
            }
            else
            {
                $('#menu_id').val( $('#parent_id').val()+ "." + convertToSlug( $('#name').val() ) ).prop("readonly", true);
                $('#parent-group').show();
            }

        });

        $('#parent_id').on('change', function(){

            $('#menu_id').val($(this).val()+ "." + convertToSlug( $('#name').val() ) ).prop("readonly", true);

        });

        $('#name').on('keyup', function(){

            var status = $('#status').val();

            if (status==1) {
                $('#menu_id').val( "frontmenu." + convertToSlug( $(this).val() ) ).prop("readonly", true);
            }
            else
            {
                $('#menu_id').val( $('#parent_id').val() + "." + convertToSlug( $(this).val() ) ).prop("readonly", true);
            }

        });

        $('#page').on('change', function(){

            var pageId = $(this).find('option:selected').data("slug");
            $('#href').val("/"+pageId).prop("readonly", true);

        });

        $('.delete').on('click', function(){

            var id = $(this).data("id");

            var $form = $('#formDeleteMenu');

            $form.find('#id').val(id);

            $('#modalDeleteMenu').modal({
                "show" : true,
                "backdrop" : "static"
            });

        });

    </script>

@stop
