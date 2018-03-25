@extends ('layouts.cpanelp')
@section ('contenido') 

@include('convocatoriasactivas.modal')
@include('convocatoriasactivas.modalP')
@include('convocatoriasactivas.modalN')
@include('convocatoriasactivas.modalC')

@if((Auth::user()->privilegio == 1))

 
  <div class="row">

    <div class="col-lg-1">  
    </div>

    <div class="col-lg-3">

        <div class="small-box bg-yellow">
            <div class="inner">
              <?php  $nro2 = DB::select('SELECT COUNT(*) as cant FROM convocatoria WHERE estado="parcial"'); ?>
                @foreach($nro2 as $res2)
                  <h3>{{$res2->cant}}</h3>
                @endforeach
              <p style="font-size: 17px;">Adjudicación Parcial</p>
            </div>

            <div class="icon">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
            </div>
            <a href="{!!URL::to('parciales')!!}" class="small-box-footer" style="font-size: 15px;">Ver Todas <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
        </div>
          
    </div>

    <div class="col-lg-1">  
    </div>

  </div>

@endif 


  <div class="row">

    <div class="col-lg-1">  
    </div>


    <div class="col-lg-10">  

        
        <center> <h2 style="text-transform: uppercase; font-weight: bold;"> Convocatorias Activas </h2> </center>


@if(Auth::user()->privilegio == 0)

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive" style="overflow-x:inherit">


      <table class="table table-striped table-bordered table-condensed table-hover" style="background: white">
          <thead>
            <th style="font-size: 16px;"><center>Título</center></th>
            <th style="font-size: 16px;"><center>Categoria</center></th>
            <th style="font-size: 16px;"><center>Fecha-Publicación</center></th>
            <th style="font-size: 16px;"><center>Opciones</center></th>
          </thead>
          <tbody align="center" id="body_empresa">          
          @foreach($sql as $mov)
          <tr>
            <td style="font-size: 15px;">{{$mov->titulo}}</td>          
            <td style="font-size: 15px;">{{$mov->nombre}}</td>
            <td style="font-size: 15px;">{{$mov->fecha}}</td>
            <td style="font-size: 15px;"> <a href="{!! nl2br(e($mov->descripcion)) !!}"><button class="btn btn-primary" style="font-size: 14px;"><i class="fa fa-download" aria-hidden="true" style="font-size: 18px;"></i> DESCARGAR</button></a> 
           


         
            <a href="{!!URL::to('form_enviar_correo')!!}" class="small-box-footer" style="font-size: 17px;"><button class='btn btn-primary' style='background-color: black; font-size: 15px;'>Enviar Propuesta</button></a>


            </td>
          </tr>
          @endforeach
          </tbody>          
      </table>

      <div class="pull-left"> {!!$sql->render()!!}  </div>
   <script src="js/sistemalaravel.js"></script>

      </div>
    </div>


@endif 



<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->



@if((Auth::user()->privilegio == 1) || (Auth::user()->privilegio == 2))


    
  <div class="col-lg-6">

          @include('alerts.success')
          @include('alerts.errors')

        <?php  $sql = DB::select('select nombre, idpublic, titulo, descripcion, DATE_FORMAT(fecha,"%d-%m-%Y") AS fecha, estado FROM categoria, convocatoria WHERE categoria.idcat=convocatoria.idcat and convocatoria.estado<>"inactiva" Order by fecha '); ?>

          <div>
            <h3> Últimas Convocatorias </h3> 
             <!--<a href="{!!URL::to('convocatoriasaprobadas')!!}"> <button class="btn btn-primary pull-right" style="font-size: 15px; background-color: black; border-color: black;">Ver Todas</button></a> -->
          </div>
          

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive" style="overflow-x:inherit">

      <table class="table table-striped table-bordered table-condensed table-hover" style="background: white">
          <thead>
            <th style="font-size: 16px;"><center>Título</center></th>
            <th style="font-size: 16px;"><center>Categoria</center></th>
            <th style="font-size: 16px;"><center>Fecha-Publicación</center></th>
            <th style="font-size: 16px;"><center>Opciones</center></th>
          </thead>
          <tbody align="center" id="body_empresa">          
       @foreach($sql as $mov)
          <tr>
            <td style="font-size: 15px;">{{$mov->titulo}}</td>          
            <td style="font-size: 15px;">{{$mov->nombre}}</td>
            <td style="font-size: 15px;">{{$mov->fecha}}</td>
            <td style="font-size: 15px;"> <a href="{!! nl2br(e($mov->descripcion)) !!}"><button class="btn btn-primary" style="font-size: 14px;"><i class="fa fa-download" aria-hidden="true" style="font-size: 18px;"></i> DESCARGAR</button></a>

            </td>

          </tr>
        @endforeach
          </tbody>          
      </table>

      </div>
    </div>

  </div>
 
@endif 


</div>



    <div class="col-lg-1">  
    </div>

  </div>

  {!!Html::script('js/jsmodal.js')!!}
 
@endsection
