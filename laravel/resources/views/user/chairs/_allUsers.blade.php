@section('users')
<table class="table table-striped">
<?php $count = 1; ?>
		<thead>
			<th>#</th>
			<td>Name</td>
			<td>Email</td>
			<td>Type</td>
		</thead>
		<tbody>
			@foreach(App\User::all() as $user)
				<tr data-userID="{{ $user->id }}">
					<td>{{ $count++ }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->type }}</td>
				</tr>
				
			@endforeach
		</tbody>
</table>
@show