<html>
	<head>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

		<style type="text/css">
			.popup {
				position: absolute;
				top: 50;
				left: 50;
				width: 30%;
				background: white;
				min-height: 20%;
				-moz-box-shadow: 0 0  30px #888;
				-webkit-box-shadow: 0 0  30px #888;
				box-shadow: 0 0  30px #888;
				display: none;
				padding: 20px 20px;
			}
		</style>
	</head>
	<body>
		<section>
			<div class="row">

				<table class="table" style="margin: 5% 5%;width: 50%;">
					<thead>
						<tr>
							<th>Name</th><th>Distance</th><th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($listing_data as $data)
						<tr>
							<td>{{ $data['list_name'] }}</td><td>{{ $data['distance'] }}</td><td><button onclick="remove('{{ $data['id'] }}')">Remove</button></td>
						</tr>
						@endforeach
					</tbody>
				</table>

				
			</div>

			<button id="add" style="margin-left: 5%;">Add</button>
			<br><br>
			<button onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</button>
		</section>

		<div class="popup">
			
			<table>
				<tr><td>Listing Name</td><td><input type="text" name="name" class="form-control" id="name"></td></tr>
				<tr><td>Distance</td><td><input type="text" name="distance" class="form-control" id="distance"></td></tr>
				<tr><td></td><td><button id="cancel">Cancel</button><button id="addList">ADD</button></td></tr>
			</table>

		</div>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

		<script type="text/javascript">

			var token = '{{ csrf_token() }}';
		    var url = '{!! url("/") !!}';
		    var userid = '{{ Auth::user()->id }}';

			function remove(id){

				$.post(url + '/remove',{_token:token, id:userid, listingid:id},function(data){

					location.reload(); 
				});
			}

			$('#addList').click(function(){

				var name = $('#name').val();
				var dis = $('#distance').val();

				$.post(url + '/add',{_token:token, id:userid, name:name, distance:dis},function(data){

					location.reload(); 
				});
			});

			$('#add').click(function(){

				$('.popup').fadeToggle();
			});	

			$('#cancel').click(function(){

				$('.popup').fadeToggle();
			});
		</script>
	</body>
</html>