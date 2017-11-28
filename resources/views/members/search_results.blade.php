@extends('adminlte::page')

@section('content_header')
    <h1>SÓCIOS</h1>
    
    <ol class="breadcrumb">
      	<div class="btn-group-horizontal">
    		<a href="{!! route('members.create') !!}" type="button" class="btn btn-sm btn-success" rel="tooltip" title="Novo"><i class="fa fa-file-o"></i></a>
	    	<a href="{!! route('members.search') !!}" type="button" class="btn btn-sm btn-info" rel="tooltip" title="Pesquisar"><i class="fa fa-search"></i></a>
	    	<a href="{!! route('dashboard.pc_members') !!}" type="button" class="btn btn-sm btn-warning" rel="tooltip" title="PC Sócios"><i class="fa fa-dashboard"></i></a>
		</div>
	</ol>
@stop


@section('content')
    <!-- Main content -->
    <section class="content">
      	<div class="row">
        	<div class="col-md-12">
          		<div class="box box-info">
		            <div class="box-header with-border">
		              <h3 class="box-title">PESQUISA</h3>
		            </div>

		            <div class="box-body"><!-- Main content -->
          				<table class="display" cellspacing="0" width="100%" id="table_members"> 
							<thead>
								<tr>
									<th>Região</th>
									<th>Cidade/UF</th>
									<th>Plano</th>
									<th>Situação</th>
									<th>Data Ent</th>
									<th>Data Sai</th>
									<th>Matrícula</th>
									<th>CPF</th>
									<th>Nome</th>
									<th>Endereço</th>
									<th>Bairro</th>	
									<th>CEP</th>
									<th>e-mail</th>
									<th>Fone</th>	
									<th>Celular</th>
									<th>Obs</th>		
								</tr>
							</thead>

							<tfoot>
								<tr>
									<th>Região</th>
									<th>Cidade/UF</th>
									<th>Plano</th>
									<th>Situação</th>
									<th>Data Ent</th>
									<th>Data Sai</th>
									<th>Matrícula</th>
									<th>CPF</th>
									<th>Nome</th>
									<th>Endereço</th>
									<th>Bairro</th>	
									<th>CEP</th>
									<th>e-mail</th>
									<th>Fone</th>	
									<th>Celular</th>
									<th>Obs</th>		
								</tr>
							</tfoot>
							
							<tbody>
								@foreach($members as $member)
							       	<tr>
									   	<td>{{ $member->region_description }}</td>
									   	<td>{{ $member->city_description }}/{{ $member->state_code }}</td>
									   	<td>{{ $member->plan_description }}</td>
									   	<td>{{ $member->member_status_description }}</td>
									   	<td>
									   		@if($member->member_status_id=='2')
                        						{{ $member->date_aafc_ini->format('d/m/Y') }}
                        					@endif
                      					</td>
                      					<td>
											@if($member->member_status_id=='1')
                        						{{ $member->date_aafc_fim->format('d/m/Y') }})
                      						@endif
                      					</td>
									   	<td class="text-right"><a href="{!! route('members.show', ['id' => $member->id]) !!}">{{ $member->code }}</a></td></td>
										<td>{{ $member->cpf_mask }}</td>
									    <td>{{ $member->name }}</td>
									    <td>{{ $member->address }}</td>
									    <td>{{ $member->neighborhood }}</td>
									    <td>{{ $member->zip_code_mask }}</td>
									    <td>{{ $member->email }}</td>
									    <td>{{ $member->phone_mask }}</td>
									    <td>{{ $member->mobile_mask }}</td>
									    <td>{{ $member->comments }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop


@section('js')
	<script type="text/javascript">
	  	$(document).ready(function() 
		{
    		$('#table_members').DataTable( 
    		{
                responsive: true,
                dom: 'Bfrtip',
		        buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
		        ],
		        language: {
            		"lengthMenu": "Display _MENU_ records per page",
            		"zeroRecords": "Ops ... Nenhum REGISTRO localizado !",
            		"info": "Showing page _PAGE_ of _PAGES_",
            		"infoEmpty": "No records available",
            		"infoFiltered": "(filtered from _MAX_ total records)"
        		}
    		});
		});	
	</script>
@endsection