<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nethus project</title>
</head>

<body>
    <h2>Historical Data</h2>
    @if (count($historicalData) > 0)
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historicalData as $data)
            <tr>
                <td>{{ $data['date']??"" }}</td>
                <td>{{ $data['open']??"" }}</td>
                <td>{{ $data['high']??"" }}</td>
                <td>{{ $data['low']??"" }}</td>
                <td>{{ $data['close']??"" }}</td>
                <td>{{ $data['volume']??"" }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No historical data available.</p>
    @endif
</body>
</html>