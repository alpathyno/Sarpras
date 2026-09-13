$viewsPath = 'C:\Tugas\Semester 5\MSI\Proyek\SIM Sarpras\resources\views'
$files = Get-ChildItem -Path $viewsPath -Recurse -Filter '*.blade.php' | Where-Object { $_.FullName -notmatch 'layouts\\app\.blade\.php' }

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    
    # Regex to match @if(session('error')) ... @endif blocks
    $content = $content -replace '(?s)@if\s*\(\s*session\(''error''\)\s*\).*?@endif\s*', ''
    # Regex to match @if(session('success')) ... @endif blocks
    $content = $content -replace '(?s)@if\s*\(\s*session\(''success''\)\s*\).*?@endif\s*', ''

    Set-Content -Path $file.FullName -Value $content
}