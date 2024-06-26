<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cases Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>

</head>

<body>
    <div style="margin-bottom:25px;"><strong>Report generated By: {{ Auth::user()->name }}</strong></div>
    <div style="margin-bottom:25px;"><strong>Report generated at: {{ Carbon\Carbon::now() }}</strong></div>
    <div style="margin-bottom:25px;"><strong>Name: {{ $result->name }}</strong></div>
    <div style="margin-bottom:25px;"><strong>Phone: {{ $result->phone }}</strong></div>
    <table style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border-bottom:2pt solid black;">
                    <strong>No</strong>
                </th>
                <th style="border-bottom:2pt solid black;">
                    <strong>Disease</strong>
                </th>
                <th style="border-bottom:2pt solid black;">
                    <strong>Probability</strong>
                </th>
                <th style="border-bottom:2pt solid black;">
                    <strong>Percentage</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($totalBayes as $value)
                <tr>
                    <td style="border-bottom:1pt solid black;">
                        {{ $loop->iteration }}
                    </td>
                    <td style="border-bottom:1pt solid black;">
                        {{ $value['name'] }}
                    </td>
                    <td style="border-bottom:1pt solid black;">
                        {{ $value['result'] }}
                    </td>
                    <td style="border-bottom:1pt solid black;">
                        {{ $value['result'] * 100 }}%
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <strong>Conclusion</strong>
        <p>
            The higher result is <strong>{{ $totalBayes[0]['name'] }}</strong> with a value of <strong>{{ $totalBayes[0]['result'] }}</strong>
        </p>
        <p><strong>Solution:</strong> {{ $totalBayes[0]['solution'] }}</p>
    </div>
</body>

</html>
