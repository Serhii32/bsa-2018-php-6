<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Currencies</title>
</head>
<body>

<h2>Currencies</h2>
<table>
	<thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Short Name</th>
            <th>Actual Course</th>
            <th>Actual Course Date</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>
    	@foreach ($jsonCurrencies as $jsonCurrency)
			<tr>
				<td>
					{{ $jsonCurrency['id'] }}
				</td>
				<td>
					{{ $jsonCurrency['name'] }}
				</td>
				<td>
					{{ $jsonCurrency['short_name'] }}
				</td>
				<td>
					{{ $jsonCurrency['actual_course'] }}
				</td>
				<td>
					{{ $jsonCurrency['actual_course_date'] }}
				</td>
				<td>
					{{ $jsonCurrency['active'] ? 'Enabled' : 'Disabled' }}
				</td>
			</tr>
    	@endforeach
    </tbody>
</table>

</body>
</html>