ALTER TABLE `shop`
ADD `lease_agreement_document` varchar(100) NOT NULL AFTER `fees_paid_challan_updated_date`,
ADD `house_tax_copy` varchar(100) NOT NULL AFTER `lease_agreement_document`,
ADD `photo_of_shop` varchar(100) NOT NULL AFTER `house_tax_copy`,
ADD `aadhar_card` varchar(100) NOT NULL AFTER `photo_of_shop`,
ADD `pan_card` varchar(100) NOT NULL AFTER `aadhar_card`,
ADD `gst` varchar(100) NOT NULL AFTER `pan_card`;