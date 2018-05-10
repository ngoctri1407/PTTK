<?php
function generateAsset($url) {
  if (env('APP_ENV') == 'dev' || env('APP_ENV') == 'stg' || env('APP_ENV') == 'pro') {
    return secure_asset($url);
  }
  return asset($url);
}

function generateUrl($url) {
  if (env('APP_ENV') == 'dev' || env('APP_ENV') == 'stg' || env('APP_ENV') == 'pro') {
    return secure_url($url);
  }
  return url($url);
}
