<?php

/*
 * This file is part of the SocialShare package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SocialShare\Provider;

/**
 * Facebook
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Facebook extends AbstractProvider
{
    const SHARE_URL = 'https://www.facebook.com/sharer/sharer.php?u=%s';
    const API_URL = 'https://graph.facebook.com/?id=%s';

    /**
     * {@inheritDoc}
     */
    public function getLink($url, array $options = array())
    {
        return sprintf(self::SHARE_URL, urlencode($url));
    }

    /**
     * {@inheritDoc}
     */
    public function getShares($url)
    {
        $data = json_decode(file_get_contents(sprintf(self::API_URL, urlencode($url))));

        return isset($data->likes) ? $data->likes : $data->shares;
    }
}