<?php

rex_extension::register('STRUCTURE_CONTENT_SIDEBAR', 'rex_metainfo_content_sidebar');

function rex_metainfo_content_sidebar(\rex_extension_point $ep)
{
    $params = $ep->getParams();

    $article = rex_article::get($params['article_id'], $params['clang']);
    $articleStatusTypes = rex_article_service::statusTypes();

    $panel = '';
    $panel .= '<dl class="dl-horizontal text-left">';

    $panel .= '<dt>' . rex_i18n::msg('created_by') . '</dt>';
    $panel .= '<dd>' . $article->getValue('createuser') . '</dd>';

    $panel .= '<dt>' . rex_i18n::msg('created_on') . '</dt>';
    $panel .= '<dd>' . rex_formatter::strftime($article->getValue('createdate'), 'date') . '</dd>';

    $panel .= '<dt>' . rex_i18n::msg('updated_by') . '</dt>';
    $panel .= '<dd>' . $article->getValue('updateuser') . '</dd>';

    $panel .= '<dt>' . rex_i18n::msg('updated_on') . '</dt>';
    $panel .= '<dd>' . rex_formatter::strftime($article->getValue('updatedate'), 'date') . '</dd>';

    $panel .= '<dt>' . rex_i18n::msg('status') . '</dt>';
    $panel .= '<dd class="' . $articleStatusTypes[$article->getValue('status')][1] . '">' . $articleStatusTypes[$article->getValue('status')][0] . '</dd>';

    $panel .= '</dl>';

    $fragment = new rex_fragment();
    $fragment->setVar('title', '<i class="rex-icon rex-icon-info"></i> ' . rex_i18n::msg('metadata'), false);
    $fragment->setVar('body', $panel, false);
    $fragment->setVar('collapse', true);
    $fragment->setVar('collapsed', true);
    $content = $fragment->parse('core/page/section.php');

    return $content;
}
