$images = @{
    'hero.jpg' = 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1600&auto=format&fit=crop&q=80'
    'reusable-bottle.jpg' = 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=800&auto=format&fit=crop&q=80'
    'bamboo-toothbrush.jpg' = 'https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?w=800&auto=format&fit=crop&q=80'
    'organic-cotton-bag.jpg' = 'https://images.unsplash.com/photo-1597484661643-2f5fef640dd1?w=800&auto=format&fit=crop&q=80'
    'recycled-notebook.jpg' = 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=800&auto=format&fit=crop&q=80'
    'bamboo-cutlery.jpg' = 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=800&auto=format&fit=crop&q=80'
    'eco-friendly-lunchbox.jpg' = 'https://images.unsplash.com/photo-1584992236310-6edddc08acff?w=800&auto=format&fit=crop&q=80'
    'reusable-coffee-cup.jpg' = 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=800&auto=format&fit=crop&q=80'
    'natural-jute-bag.jpg' = 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=800&auto=format&fit=crop&q=80'
    'solar-garden-light.jpg' = 'https://images.unsplash.com/photo-1509391365360-2e959784a276?w=800&auto=format&fit=crop&q=80'
    'biodegradable-pots.jpg' = 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?w=800&auto=format&fit=crop&q=80'
    'coconut-shell-bowl.jpg' = 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&auto=format&fit=crop&q=80'
    'reusable-food-bags.jpg' = 'https://images.unsplash.com/photo-1610557892470-55d9e80c0bce?w=800&auto=format&fit=crop&q=80'
    'about-mission.jpg' = 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=1000&auto=format&fit=crop&q=80'
    'about-team.jpg' = 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?w=1000&auto=format&fit=crop&q=80'
}

$destDir = "c:\Users\Pratul V\Web Programming Project\ecomart\assets\images"

foreach ($key in $images.Keys) {
    $url = $images[$key]
    $dest = Join-Path $destDir $key
    Write-Host "Downloading $key..."
    Invoke-WebRequest -Uri $url -OutFile $dest -UserAgent "Mozilla/5.0"
}
Write-Host "All images downloaded successfully!"
