<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Career Test Report</title>
    <style>
        @page {
            margin: 28px 22px 40px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.45;
            color: #20323d;
        }

        h1, h2, h3, h4 {
            margin: 0 0 8px;
            color: #1e6d95;
        }

        p {
            margin: 0 0 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-title {
            margin-bottom: 14px;
        }

        .page-title img {
            max-width: 240px;
        }

        .subtitle {
            margin-top: 6px;
            font-size: 14px;
            font-weight: bold;
        }

        .card {
            margin-bottom: 18px;
        }

        .identity {
            background: #0b617e;
            color: #ffffff;
        }

        .identity td {
            width: 50%;
            padding: 14px 18px;
            vertical-align: top;
        }

        .detail-table td {
            padding: 6px 0;
            vertical-align: top;
        }

        .detail-label {
            width: 70px;
            color: #ffffff;
        }

        .detail-colon {
            width: 10px;
            color: #ffffff;
        }

        .detail-value {
            font-weight: bold;
            color: #ffffff;
        }

        .score-layout td {
            vertical-align: top;
        }

        .score-panel {
            width: 68%;
            padding-right: 22px;
        }

        .summary-panel {
            width: 32%;
        }

        .score-table td {
            padding: 8px 0;
            vertical-align: middle;
        }

        .score-name {
            width: 145px;
            padding-right: 12px !important;
            font-weight: bold;
            color: #0b617e;
            text-transform: uppercase;
        }

        .score-bar-wrap {
            width: 100%;
            background: #b6e2ea;
            height: 18px;
        }

        .score-bar-fill {
            height: 18px;
            background: #0b617e;
        }

        .score-value {
            width: 34px;
            padding-left: 10px !important;
            text-align: right;
            font-weight: bold;
            color: #20323d;
        }

        .summary-code-table td {
            padding: 6px 6px 0 0;
            text-align: center;
            vertical-align: middle;
        }

        .summary-box {
            width: 34px;
            height: 34px;
            background: #b6e2ea;
            color: #1e6d95;
            font-size: 22px;
            font-weight: bold;
            line-height: 34px;
            text-align: center;
        }

        .summary-score {
            font-weight: bold;
            color: #20323d;
        }

        .section {
            margin-bottom: 16px;
        }

        .section h3 {
            margin-bottom: 6px;
        }

        .hex-wrap {
            text-align: center;
            margin: 10px 0 18px;
        }

        .hex-wrap img {
            max-width: 200px;
        }

        .type-block {
            margin-bottom: 12px;
            page-break-inside: avoid;
        }

        .theme {
            color: #1e6d95;
            font-weight: bold;
        }

        .occupation-group {
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .occupation-group h4 {
            text-transform: uppercase;
            font-weight: normal;
            margin-bottom: 8px;
        }

        .occupation-table td {
            width: 50%;
            padding: 3px 10px 3px 0;
            vertical-align: top;
        }

        ul {
            margin: 6px 0 10px 18px;
            padding: 0;
        }

        li {
            margin-bottom: 4px;
        }

        .page-break {
            page-break-after: always;
        }

        .capitalize {
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <script type="text/php">
    if (isset($pdf)) {
        $font = $fontMetrics->getFont("Helvetica", "normal");
        $pdf->page_text(470, 810, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0, 0, 0));
    }
    </script>

    <div class="page-title">
        @php($logoPath = public_path('img/career-preference-logo.jpg'))
        @if(file_exists($logoPath))
            <img src="{{ $logoPath }}" alt="Career Preference">
        @endif
        <div class="subtitle">The Preferred Career Test Online</div>
    </div>

    <div class="card">
        <table class="identity">
            <tr>
                <td>
                    <table class="detail-table">
                        <tr>
                            <td class="detail-label">Name</td>
                            <td class="detail-colon">:</td>
                            <td class="detail-value capitalize">{{ $user->firstname }} {{ $user->lastname }}</td>
                        </tr>
                        <tr>
                            <td class="detail-label">Age</td>
                            <td class="detail-colon">:</td>
                            <td class="detail-value">{{ $user->age }}</td>
                        </tr>
                        <tr>
                            <td class="detail-label">Gender</td>
                            <td class="detail-colon">:</td>
                            <td class="detail-value capitalize">{{ $user->gender }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="detail-table">
                        <tr>
                            <td class="detail-label">Group</td>
                            <td class="detail-colon">:</td>
                            <td class="detail-value capitalize">{{ $user->stgroup }}</td>
                        </tr>
                        <tr>
                            <td class="detail-label">Test Date</td>
                            <td class="detail-colon">:</td>
                            <td class="detail-value">{{ date('d-m-Y', strtotime($user->updated_at)) }}</td>
                        </tr>
                        <tr>
                            <td class="detail-label">Country</td>
                            <td class="detail-colon">:</td>
                            <td class="detail-value capitalize">{{ $user->country }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="card">
        <table class="score-layout">
            <tr>
                <td class="score-panel">
                    <h3>RIASEC Personality Type Score</h3>
                    <table class="score-table">
                        @foreach ($scores as $score)
                            @php($percent = max(0, min(100, ((float) $score->value / 15) * 100)))
                            <tr>
                                <td class="score-name">{{ $score->name }}</td>
                                <td>
                                    <div class="score-bar-wrap">
                                        <div class="score-bar-fill" style="width: {{ $percent }}%;"></div>
                                    </div>
                                </td>
                                <td class="score-value">{{ $score->value }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td class="summary-panel">
                    <h3>Your Summary Code</h3>
                    <table class="summary-code-table">
                        <tr>
                            <td></td>
                            @foreach ($scores as $score)
                                @if ($loop->index < 3)
                                    <td><div class="summary-box">{{ mb_substr($score->name, 0, 1) }}</div></td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>Score</td>
                            @foreach ($scores as $score)
                                @if ($loop->index < 3)
                                    <td class="summary-score">{{ $score->value }}</td>
                                @endif
                            @endforeach
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Introduction</h3>
        <p>The Career Assessment report provides you with possible career options that you can explore based on the summary code generated from your test results. The site also provides suggestions and resources to help you with your career planning process. Every code is different and may vary in the number of career options provided below.</p>
    </div>

    <div class="section">
        <h3>Overview of Holland's RIASEC Types</h3>
        <p>The theory is based on extensive research about how people choose careers which was first developed by Dr. John Holland in 1971. It is the most widely used interest inventory in the world. It is based upon a theory that people can be loosely classified into six different personality types: Realistic, Investigative, Artistic, Social, Enterprising, and Conventional.</p>
        <p>The theory suggests people prefer jobs and careers where they can be around others who are like them. They search for environments that let them use their skills and abilities, and express their attitudes and values while taking on enjoyable problems and roles.</p>
    </div>

    <div class="page-break"></div>

    <div class="section">
        <h3>Which Type Are You?</h3>
        <p>RIASEC letters can be used to describe the personality type a person's interests most resemble. A hexagon is used to show similarities and differences among the six types. Types that are next to each other on the hexagon are the most similar.</p>
        <div class="hex-wrap">
            @php($hexPath = public_path('img/report_hex.png'))
            @if(file_exists($hexPath))
                <img src="{{ $hexPath }}" alt="RIASEC Hexagon">
            @endif
        </div>
    </div>

    <div class="type-block">
        <h4>REALISTIC</h4>
        <p>Realistic people tend to have athletic interests, prefer to work with objects, machines, tools, plants or animals, and like to be outdoors.</p>
        <p><span class="theme">Characteristics:</span> Independent, Practical, Systematic, Self-Controlled, Straightforward<br><span class="theme">Working Environment:</span> Agriculture, Construction, Manufacturing, Distribution, Transport, Shipping and Aviation</p>
    </div>

    <div class="type-block">
        <h4>INVESTIGATIVE</h4>
        <p>Investigative people like to observe, learn, investigate, analyze, and solve problems.</p>
        <p><span class="theme">Characteristics:</span> Logical, Curious, Thoughtful, Observant, Intellectual<br><span class="theme">Working Environment:</span> Academic Education, IT, Healthcare and Innovative Companies</p>
    </div>

    <div class="type-block">
        <h4>ARTISTIC</h4>
        <p>Artistic people like to work in unstructured situations using imagination and creativity.</p>
        <p><span class="theme">Characteristics:</span> Creative, Imaginative, Unconventional, Expressive, Innovative, Impulsive<br><span class="theme">Working Environment:</span> Advertising, Music and Entertainment, Theatre, Art, and creative design</p>
    </div>

    <div class="type-block">
        <h4>SOCIAL</h4>
        <p>Social people like to work with people to inspire, inform, help, train, or care for them.</p>
        <p><span class="theme">Characteristics:</span> Patient, Insightful, Responsible, Cooperative, Outgoing, Skilled with words<br><span class="theme">Working Environment:</span> Government, Education, Healthcare and Social Services</p>
    </div>

    <div class="type-block">
        <h4>ENTERPRISING</h4>
        <p>Enterprising people like to work with people to influence, persuade and lead them, and to achieve goals.</p>
        <p><span class="theme">Characteristics:</span> Assertive, Energetic, Persuasive, Ambitious, Optimistic<br><span class="theme">Working Environment:</span> Management, Sales and Marketing, Trade, Administration and Politics</p>
    </div>

    <div class="type-block">
        <h4>CONVENTIONAL</h4>
        <p>Conventional people like to work with information, carry out detailed tasks, and have clerical or numerical interests.</p>
        <p><span class="theme">Characteristics:</span> Efficient, Well-Organized, Persistent, Methodical, Conscientious<br><span class="theme">Working Environment:</span> Banking and Finance, Management and Administrative, Government</p>
    </div>

    <div class="page-break"></div>

    <div class="section">
        <h3>Careers That Match Your Personality Type</h3>
        <p>Below are the jobs for your three highest summary codes. The first letter of your code represents the careers most suitable for your personality type. The second and third letters represent the next careers most suitable for your personality type.</p>
    </div>

    <div class="section">
        <h2>Exploring Occupations</h2>
        @foreach ($occupations as $key => $val)
            <div class="occupation-group">
                <h4>{{ $key }} Occupations</h4>
                @php($occupationRows = $val->where('personalitytype', $key)->values()->chunk(2))
                <table class="occupation-table">
                    @foreach ($occupationRows as $row)
                        <tr>
                            <td>@if(isset($row[0]))&bull; {{ $row[0]->occupationen }}@endif</td>
                            <td>@if(isset($row[1]))&bull; {{ $row[1]->occupationen }}@endif</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>

    <div class="section">
        <h3>Next Step</h3>
        <p>Identify and highlight those careers that may interest you. Research those careers in detail and compare them against your own ambitions and requirements.</p>
        <h4>Things you should consider when researching careers:</h4>
        <ul>
            <li>Will there be a strong demand for that career in the future?</li>
            <li>What trends could influence that demand?</li>
            <li>Will there be local jobs in that field, or will you have to relocate?</li>
            <li>What skills, education, training, languages and experience are required?</li>
            <li>Will the job pay enough?</li>
            <li>Will you find satisfaction in that career and will it be fulfilling?</li>
            <li>Do you have what it takes to be successful in that field?</li>
        </ul>
        <h4>How do I get more information?</h4>
        <p>Step 1: Select about ten careers that you are interested in from your career test report.</p>
        <p>Step 2: Go to https://www.onetonline.org/ and search for information about those careers.</p>
        <p>Step 3: Explore universities that offer courses in the fields you shortlisted and compare entry requirements, tuition fees and course duration.</p>
        <p>If you need further career guidance, write to enquiry@ark.com.my.</p>
        <p>Thank you for taking the Career Preference Test.</p>
        <p>&copy; Copyright Ark Publications. All Rights Reserved.</p>
    </div>
</body>
</html>
