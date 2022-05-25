<?php
function getIdFromURL(string $url){
    $result = NULL;

    // Youtube url
    $url_string = parse_url($url, PHP_URL_QUERY);
    parse_str($url_string, $args);
    if (isset($args['v']))
        $result = (strlen($args['v']) === 11) ? $args['v'] : false;

    $pattern = "/^https:\/\/youtu\.be\/[a-zA-Z0-9-_]{11}$/";
    if (preg_match($pattern, $url)) 
        $result = explode("be/", $url)[1];

    // Spotify url
    $pattern = "/^https:\/\/open\.spotify\.com\/track\/[a-zA-Z0-9-_]{22}$/";
    if (preg_match($pattern, $url)) 
        $result = explode("track/", $url)[1];
        
    return $result;
}

function displayYoutubeVideo($id, $nom) : void { ?>
    <iframe class="video"
        src="https://www.youtube-nocookie.com/embed/<?php echo htmlspecialchars($id); ?>"
        
        title="<?php echo $nom; ?>"
        frameborder="0"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
    </iframe>
<?php }

function displaySpotifyTrack($id) : void { ?>
    <iframe 
        src="https://open.spotify.com/embed/track/<?php echo htmlspecialchars($id); ?>?utm_source=generator" 
        height="80"
        frameBorder="0" 
        allowfullscreen="" 
        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture">
    </iframe>
<?php }


function isGoodYtbUrl(string $url): bool {
    $pattern = "/(^https:\/\/www\.youtube\.com\/watch\?v=[-0-9a-zA-Z_]{11}$)|(^https:\/\/youtu\.be\/[a-zA-Z0-9-_]{11}$)/";
    if (preg_match($pattern, $url)) 
        return true;
    else return false;
}

function isGoodSpotifyUrl(string $url): bool {
    $pattern = "/(^https:\/\/open\.spotify\.com\/track\/[a-zA-Z0-9-_]{22}$)/";
    if (preg_match($pattern, $url)) 
        return true;
    else return false;
}