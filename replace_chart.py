import re

file_path = 'resources/views/users/chart.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

# Replace ternary: {{ $fatherGrandpa ? $fatherGrandpa->profileLink('chart') : '?' }}
pattern1 = r'\{\{\s*\$([a-zA-Z0-9_]+)\s*\?\s*\$([a-zA-Z0-9_]+)->profileLink\(\'chart\'\)\s*:\s*\'\?\'\s*\}\}'
def replace_func1(match):
    var = match.group(1)
    return f"@if(${var})\n                        @include('users.partials.tree-node', ['userNode' => ${var}, 'type' => 'chart'])\n                    @else\n                        ?\n                    @endif"
content = re.sub(pattern1, replace_func1, content)

# Replace direct: {{ $user->profileLink('chart') }}
pattern2 = r'\{\{\s*\$([a-zA-Z0-9_]+)->profileLink\(\'chart\'\)\s*\}\}'
def replace_func2(match):
    var = match.group(1)
    return f"@include('users.partials.tree-node', ['userNode' => ${var}, 'type' => 'chart'])"
content = re.sub(pattern2, replace_func2, content)

with open(file_path, 'w') as f:
    f.write(content)
