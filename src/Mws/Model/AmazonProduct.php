<?php

namespace Ofertix\Mws\Model;

/**
 * Class AmazonProduct
 *
 * @package Ofertix\Mws\Model
 */
class AmazonProduct implements UploadableProductInterface, AmazonFeedTypeInterface
{
    use AmazonFeedTypeTrait;
    const FEED_NAME = 'product';

    protected $id;
    /** @var Ean13  */
    protected $ean13;
    /** @var  Asin */
    protected $asin;
    protected $sku;
    protected $brand;
    protected $title;
    protected $model;
    protected $color;
    protected $size;
    protected $url;
    protected $productGroup;
    protected $productType;
    protected $stock;
    protected $salePrice;
    protected $costPrice;
    protected $description;
    protected $moreInfo;
    protected $currency;
    protected $parentSku;
    protected $launchDate;
    protected $category;
    protected $clothingType;

    /**
     * @var Image[]
     */
    protected $images;

    /**
     * AmazonProduct constructor.
     * @param Ean13 $ean13
     * @param string  $brand
     * @param string  $title
     */
    public function __construct(Ean13 $ean13, $brand, $title)
    {
        $this->ean13 = $ean13;
        $this->brand = $brand;
        $this->title = $title;
        $this->images = array();
    }


    /**
     * @return \SimpleXMLElement|String
     */
    public function xmlNode()
    {
        $rootNode = new \SimpleXMLElement('<'.$this->feedName().'></'.$this->feedName().'>');
        $rootNode->addChild('SKU', $this->sku());
        $pid = $rootNode->addChild('StandardProductID');
        $pid->addChild('Type', 'EAN');
        $pid->addChild('Value', $this->ean13());
        if (null !== $this->launchDate()) {
            $rootNode->addChild('LaunchDate', $this->launchDate());
        }
        $conditionNode = $rootNode->addChild('Condition');
        $conditionNode->addChild('ConditionType', 'New');
        $descNode = $rootNode->addChild('DescriptionData');
        $descNode->addChild('Title', $this->title());
        $descNode->addChild('Brand', $this->brand());
        $descNode->addChild('Description', $this->description());
        //        if (isset($this->amazonProduct['search_terms'])) {
        //            foreach ($this->amazonProduct['search_terms'] as $searchTerm) {
        //                $descNode->addChild('SearchTerms', $searchTerm);
        //            }
        //        }
        $descNode->addChild('ItemType', 'flat-sheets');
        //        if (isset($this->amazonProduct['recommended_browse_node'])) {
        //            $descNode->addChild('RecommendedBrowseNode', $this->amazonProduct['recommended_browse_node']);
        //        }
        $this->createProducDataNode($rootNode);

        return $rootNode;

    }
    /**
     * Get Id
     *
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return AmazonProduct
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Ean13
     *
     * @return Ean13
     */
    public function ean13()
    {
        return $this->ean13;
    }

    /**
     * @param Ean13 $ean13
     *
     * @return AmazonProduct
     */
    public function setEan13($ean13)
    {
        $this->ean13 = $ean13;

        return $this;
    }

    /**
     * Get Asin
     *
     * @return Asin
     */
    public function asin()
    {
        return $this->asin;
    }

    /**
     * @param Asin $asin
     *
     * @return AmazonProduct
     */
    public function setAsin(Asin $asin)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get Sku
     *
     * @return mixed
     */
    public function sku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     *
     * @return AmazonProduct
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get Brand
     *
     * @return string
     */
    public function brand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     *
     * @return AmazonProduct
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return AmazonProduct
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get Model
     *
     * @return string
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @param string $model
     *
     * @return AmazonProduct
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get Color
     *
     * @return mixed
     */
    public function color()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     *
     * @return AmazonProduct
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get Size
     *
     * @return mixed
     */
    public function size()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     *
     * @return AmazonProduct
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get Url
     *
     * @return mixed
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     *
     * @return AmazonProduct
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get ProductGroup
     *
     * @return mixed
     */
    public function productGroup()
    {
        return $this->productGroup;
    }

    /**
     * @param mixed $productGroup
     *
     * @return AmazonProduct
     */
    public function setProductGroup($productGroup)
    {
        $this->productGroup = $productGroup;

        return $this;
    }

    /**
     * Get ProductType
     *
     * @return mixed
     */
    public function productType()
    {
        return $this->productType;
    }

    /**
     * @param mixed $productType
     *
     * @return AmazonProduct
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get Stock
     *
     * @return mixed
     */
    public function stock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     *
     * @return AmazonProduct
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get SalePrice
     *
     * @return mixed
     */
    public function salePrice()
    {
        return $this->salePrice;
    }

    /**
     * @param mixed $salePrice
     *
     * @return AmazonProduct
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    /**
     * Get CostPrice
     *
     * @return mixed
     */
    public function costPrice()
    {
        return $this->costPrice;
    }

    /**
     * @param mixed $costPrice
     *
     * @return AmazonProduct
     */
    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    /**
     * Get Description
     *
     * @return mixed
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return AmazonProduct
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get MoreInfo
     *
     * @return mixed
     */
    public function moreInfo()
    {
        return $this->moreInfo;
    }

    /**
     * @param mixed $moreInfo
     *
     * @return AmazonProduct
     */
    public function setMoreInfo($moreInfo)
    {
        $this->moreInfo = $moreInfo;

        return $this;
    }

    /**
     * Get Images
     *
     * @return array
     */
    public function images()
    {
        return $this->images;
    }

    /**
     * @param Image $image
     *
     * @return $this
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Get Currency
     *
     * @return mixed
     */
    public function currency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     *
     * @return AmazonProduct
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get ParentSku
     *
     * @return mixed
     */
    public function parentSku()
    {
        return $this->parentSku;
    }

    /**
     * @param mixed $parentSku
     *
     * @return AmazonProduct
     */
    public function setParentSku($parentSku)
    {
        $this->parentSku = $parentSku;

        return $this;
    }

    /**
     * Get LaunchDate
     *
     * @return mixed
     */
    public function launchDate()
    {
        return $this->launchDate;
    }

    /**
     * @param mixed $launchDate
     *
     * @return AmazonProduct
     */
    public function setLaunchDate($launchDate)
    {
        $this->launchDate = ($launchDate instanceof \DateTime) ? $launchDate->format('c') : $launchDate;

        return $this;
    }

    /**
     * Get Category
     *
     * @return mixed
     */
    public function category()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     *
     * @return AmazonProduct
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get ClothingType
     *
     * @return mixed
     */
    public function clothingType()
    {
        return $this->clothingType;
    }

    /**
     * @param mixed $clothingType
     *
     * @return AmazonProduct
     */
    public function setClothingType($clothingType)
    {
        $this->clothingType = $clothingType;

        return $this;
    }

    /**
     * @param $rootNode
     *
     * @return mixed
     * ToDo: implement generation of this product category type
     */
    protected function createProducDataNode($rootNode)
    {

        if ($this->category() == 'Clothing') {

            return $this->createClothingNode($rootNode);
        }

        if ($this->category() == 'ClothingAccessories') {
        }

        if ($this->category() == 'Miscellaneous') {
        }

        if ($this->category() == 'CameraPhoto') {
        }

        if ($this->category() == 'Home') {
        }

        if ($this->category() == 'Sports') {
        }

        if ($this->category() == 'SportsMemorabilia') {
        }

        if ($this->category() == 'EntertainmentCollectibles') {
        }

        if ($this->category() == 'HomeImprovement') {
        }

        if ($this->category() == 'Tools') {
        }

        if ($this->category() == 'FoodAndBeverages') {
        }

        if ($this->category() == 'Gourmet') {
        }

        if ($this->category() == 'Jewelry') {
        }

        if ($this->category() == 'Health') {
        }

        if ($this->category() == 'CE') {
        }

        if ($this->category() == 'Computers') {
        }

        if ($this->category() == 'SoftwareVideoGames') {
        }

        if ($this->category() == 'Wireless') {
        }

        if ($this->category() == 'Beauty') {
        }

        if ($this->category() == 'Office') {
        }

        if ($this->category() == 'MusicalInstruments') {
        }

        if ($this->category() == 'AutoAccessory') {
        }

        if ($this->category() == 'PetSupplies') {
        }

        if ($this->category() == 'ToysBaby') {
        }

        if ($this->category() == 'Baby') {
        }

        if ($this->category() == 'TiresAndWheels') {
        }

        if ($this->category() == 'Music') {
        }

        if ($this->category() == 'Video') {
        }

        if ($this->category() == 'Lighting') {
        }

        if ($this->category() == 'LargeAppliances') {
        }

        if ($this->category() == 'FBA') {
        }

        if ($this->category() == 'Toys') {
        }

        if ($this->category() == 'GiftCard') {
        }

        if ($this->category() == 'LabSupplies') {
        }

        if ($this->category() == 'RawMaterials') {
        }

        if ($this->category() == 'PowerTransmission') {
        }

        if ($this->category() == 'Industrial') {
        }

        if ($this->category() == 'Shoes') {
        }

        if ($this->category() == 'Motorcycles') {
        }

        if ($this->category() == 'MechanicalFasteners') {
        }

        if ($this->category() == 'FoodServiceAndJanSan') {
        }

        if ($this->category() == 'WineAndAlcohol') {
        }

        if ($this->category() == 'EUCompliance') {
        }

        if ($this->category() == 'Books') {
        }

        if ($this->category() == 'AdditionalProductInformation') {
        }

        if ($this->category() == 'Arts') {
        }

        if ($this->category() == 'Luggage') {
        }

        return null;
    }

    protected function createClothingNode($rootNode)
    {
        $productDataNode = $rootNode->addChild('ProductData');
            $productDataCategoryNode = $productDataNode->addChild('Clothing');
                $variationDataNode = $productDataCategoryNode->addChild('VariationData');
                    $variationDataNode->addChild('Size', $this->size());
                    $variationDataNode->addChild('Color', $this->color());
            $classificationDataNode = $productDataCategoryNode->addChild('ClassificationData');
                $classificationDataNode->addChild('ClothingType', $this->clothingType());
                $classificationDataNode->addChild('Department', $this->category());
                $classificationDataNode->addChild('MaterialComposition', $this->moreInfo());
                $classificationDataNode->addChild('OuterMaterial', $this->moreInfo());

        return $productDataNode;
    }


}
