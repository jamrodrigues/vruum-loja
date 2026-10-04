{assign var=_counter value=0}
{function name="menu" nodes=[] depth=0 parent=null}
    {if $nodes|count}
      <ul class="top-menu" {if $depth == 0}id="top-menu"{/if} data-depth="{$depth}">
        {foreach from=$nodes item=node}
            <li class="{$node.type}{if $node.current} current {/if}" id="{$node.page_identifier}">
            {assign var=_counter value=$_counter+1}
              <a
                class="{if $depth >= 0}dropdown-item{/if}{if $depth === 1} dropdown-submenu{/if}"
                href="{$node.url}" data-depth="{$depth}"
                {if $node.open_in_new_window} target="_blank" {/if}
              >
                {if $node.children|count}
                  {* Cannot use page identifier as we can have the same page several times *}
                  {assign var=_expand_id value=10|mt_rand:100000}
                  <span class="float-xs-right hidden-md-up">
                    <span data-target="#top_sub_menu_{$_expand_id}" data-toggle="collapse" class="navbar-toggler collapse-icons">
                      <i class="material-icons add">&#xE313;</i>
                      <i class="material-icons remove">&#xE316;</i>
                    </span>
                  </span>
                {/if}
                {if $depth == 0}
                  {assign var=_cat_id value=$node.page_identifier|replace:'category-':''}
                  {if $_cat_id == 3}{assign var=_icon value='icon-filtro'}
                  {elseif $_cat_id == 4}{assign var=_icon value='icon-freio'}
                  {elseif $_cat_id == 5}{assign var=_icon value='icon-motor'}
                  {elseif $_cat_id == 7}{assign var=_icon value='icon-capacete'}
                  {elseif $_cat_id == 8}{assign var=_icon value='icon-jaqueta'}
                  {elseif $_cat_id == 9}{assign var=_icon value='icon-acessorios'}
                  {elseif $_cat_id == 10}{assign var=_icon value='icon-pneu'}
                  {elseif $_cat_id == 11}{assign var=_icon value='icon-bau'}
                  {elseif $_cat_id == 12}{assign var=_icon value='icon-oleo'}
                  {elseif $_cat_id == 13}{assign var=_icon value='icon-som'}
                  {elseif $_cat_id == 14}{assign var=_icon value='icon-ferramenta'}
                  {elseif $_cat_id == 15}{assign var=_icon value='icon-iluminacao'}
                  {elseif $_cat_id == 16}{assign var=_icon value='icon-protecao'}
                  {else}{assign var=_icon value='icon-motor'}
                  {/if}
                  <svg class="top-menu-icon-svg"><use href="{$urls.base_url}themes/classic/assets/img/category-icons.svg#{$_icon}"></use></svg>
                {/if}
                {$node.label}
              </a>
              {if $node.children|count}
              <div {if $depth === 0} class="popover sub-menu js-sub-menu collapse"{else} class="collapse"{/if} id="top_sub_menu_{$_expand_id}">
                {menu nodes=$node.children depth=$node.depth parent=$node}
              </div>
              {/if}
            </li>
        {/foreach}
      </ul>
    {/if}
{/function}

<div class="menu js-top-menu position-static hidden-sm-down" id="_desktop_top_menu">
    {menu nodes=$menu.children}
    <div class="clearfix"></div>
</div>
