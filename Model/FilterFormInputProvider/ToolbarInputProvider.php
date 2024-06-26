<?php

namespace Tweakwise\Magento2Tweakwise\Model\FilterFormInputProvider;

use Magento\Framework\App\Request\Http as MagentoHttpRequest;
use Magento\Catalog\Model\Product\ProductList\Toolbar;

class ToolbarInputProvider implements FilterFormInputProviderInterface
{
    public const TOOLBAR_INPUTS = [
        Toolbar::DIRECTION_PARAM_NAME,
        Toolbar::LIMIT_PARAM_NAME,
        Toolbar::MODE_PARAM_NAME,
        Toolbar::ORDER_PARAM_NAME,
        Toolbar::PAGE_PARM_NAME
    ];

    /**
     * @var MagentoHttpRequest
     */
    protected $request;

    /**
     * ToolbarInputProvider constructor.
     * @param MagentoHttpRequest $request
     */
    public function __construct(MagentoHttpRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function getFilterFormInput()
    {
        $input = [];
        foreach (self::TOOLBAR_INPUTS as $toolbarInput) {
            $toolbarInputValue = $this->request->getParam($toolbarInput);
            if ($toolbarInputValue) {
                $input[$toolbarInput] = filter_var($toolbarInputValue, FILTER_SANITIZE_ENCODED);
            }
        }

        return $input;
    }
}
