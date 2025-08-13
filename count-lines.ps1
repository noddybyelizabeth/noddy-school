param(
    [string]$Path = ".",
    [string[]]$Include = @("*.php", "*.js", "*.css", "*.html"),
    [string[]]$Exclude = @("vendor", "node_modules", ".git")
)

$totalLines = 0
$fileCount = 0

Get-ChildItem -Path $Path -Recurse -Include $Include |
Where-Object {
    $excluded = $false
    foreach ($ex in $Exclude) {
        if ($_.FullName -like "*$ex*") {
            $excluded = $true
            break
        }
    }
    -not $excluded
} |
ForEach-Object {
    $lines = (Get-Content $_.FullName | Measure-Object -Line).Lines
    $totalLines += $lines
    $fileCount++

    Write-Host "$($_.Name): $lines lines" -ForegroundColor Green
}

Write-Host "`nTotal: $totalLines lines in $fileCount files" -ForegroundColor Yellow